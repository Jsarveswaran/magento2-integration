<?php
declare(strict_types=1);

namespace Saleswarp\SaleswarpShipDev\Setup\Patch\Data;

use Magento\Integration\Model\ConfigBasedIntegrationManager;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;

/**
 * Setup data patch class to change config path
 */
class PatchData implements DataPatchInterface
{

    /**
     * @var ConfigBasedIntegrationManager
     */
     private $integrationManager;

    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * @param ConfigBasedIntegrationManager $integrationManager
     */
    public function __construct(
    	ConfigBasedIntegrationManager $integrationManager,
    	ModuleDataSetupInterface $moduleDataSetup,
    	EavSetupFactory $eavSetupFactory)
    {
        $this->integrationManager = $integrationManager;
		$this->moduleDataSetup    = $moduleDataSetup;
        $this->eavSetupFactory    = $eavSetupFactory;
    }

    /**
     * @inheritdoc
     */
    public function apply()
    {
        $this->integrationManager->processIntegrationConfig(['SaleswarpShipDev']);
    }

    /**
     * @inheritdoc
     */
    public function revert()
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);

        $eavSetup->delete($setup->getTable('patch_list'), ['patch_name = ?' => 'Saleswarp\SaleswarpShipDev%']);
        $eavSetup->delete($setup->getTable('integration'), ['name = ?' => 'SaleswarpShipDev%']);
		$eavSetup->query("DELETE FROM `patch_list` WHERE `patch_list`.`patch_name` LIKE 'Saleswarp\SaleswarpShipDev%'");
 
        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * @inheritdoc
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public static function getVersion()
    {
        return '1.0.0';
    }

    /**
     * @inheritdoc
     */
    public function getAliases()
    {
        return [];
    }
}
