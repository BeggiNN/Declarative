<?php

namespace Perspective\Schema\Console\Command;

use Perspective\Schema\Model\ResourceModel\Post as PostResource;
use Magento\Framework\App\ResourceConnection;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class RemoveSampleDataCommand extends Command
{
    /**
     * @var ResourceConnection
     */
    private $resourceConnection;

    /**
     * @param ResourceConnection $resourceConnection
     */
    public function __construct(
        ResourceConnection $resourceConnection
    ) {
        parent::__construct();
        $this->resourceConnection = $resourceConnection;
    }

    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this->setName('perspective:schema:remove_sample_data')
            ->setDescription('Blog: remove sample data')
        ;
        parent::configure();
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $connection = $this->resourceConnection->getConnection();
        $connection->truncateTable($connection->getTableName(PostResource::TABLE_NAME));
        if ($output->getVerbosity() > 1) {
            $output->writeln('<info>Sample data has been successfully.</info>');
        }
    }
}
