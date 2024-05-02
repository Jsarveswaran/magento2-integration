<?php
namespace Saleswarp\SaleswarpShip\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Integration\Model\ConfigBasedIntegrationManager;
use Magento\Framework\Setup\InstallDataInterface;

class InstallData implements InstallDataInterface
{
    /**
     * @var ConfigBasedIntegrationManager
     */
    private $integrationManager;

    /**
     * @param ConfigBasedIntegrationManager $integrationManager
     */
    public function __construct(ConfigBasedIntegrationManager $integrationManager)
    {
        $this->integrationManager = $integrationManager;
    }

    /**
     * Installs data for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $this->integrationManager->processIntegrationConfig(['SaleswarpShip']);
    }
}
