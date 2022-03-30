<?php

namespace Custom\SampleModule\Console\Command;

use Magento\Framework\Console\Cli;
use Symfony\Component\Console\Command\Command;
use Custom\SampleModule\Model\ItemFactory;
use Symfony\Component\Console\Helper\ProgressBarFactory;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AddItem extends Command
{
    const INPUT_KEY_NAME = 'name';
    const INPUT_KEY_DESCRIPTION = 'description';
    const OUTPUT_SUCCESS = "Item added!";

    private ItemFactory $itemFactory;
    private ProgressBarFactory $progressBarFactory;

    public function __construct(ProgressBarFactory $progressBarFactory, ItemFactory $itemFactory)
    {
        $this->progressBarFactory = $progressBarFactory;
        $this->itemFactory = $itemFactory;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('custom:item:add')
            ->addArgument(
                self::INPUT_KEY_NAME,
                InputArgument::REQUIRED,
                'Item name'
            )->addArgument(
                self::INPUT_KEY_DESCRIPTION,
                InputArgument::OPTIONAL,
                'Item description'
            );
        $this->setDescription('Add item to custom_sample_item table');
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        try {

            $progressBar = $this->progressBarFactory->create(
                [
                    'output' => $output,
                    'max' => 1
                ]
            );
            $progressBar->setFormat(
                '%current%/%max% [%bar%] %percent:3s%% %elapsed% %memory:6s%'
            );

            $progressBar->start();

            $item = $this->itemFactory->create();
            $item->setName($input->getArgument(self::INPUT_KEY_NAME));
            $item->setDescription($input->getArgument(self::INPUT_KEY_DESCRIPTION));
            $item->setIsObjectNew(true);
            $item->save();

            $progressBar->finish();
            $output->writeln(' ');
            $output->write('<info>'.self::OUTPUT_SUCCESS.'</info>', true);
            return Cli::RETURN_SUCCESS;

        }catch (\Exception $exception){
            $output->writeln('<error>'.$exception->getMessage().'</error>');
            return Cli::RETURN_FAILURE;
        }
    }
}
