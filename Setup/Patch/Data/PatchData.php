<?php
declare(strict_types=1);

namespace Saleswarp\SaleswarpShip\Setup\Patch\Data;

use Saleswarp\SaleswarpShip\Setup\InstallData;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

/**
 * Setup data patch class to change config path
 */
class PatchData implements DataPatchInterface
{

    /**
     * @var InstallData
     */
    private $installData;

    /**
     * @var ConfigBasedIntegrationManager
     */
     private $integrationManager;

    /**
     * @param InstallData $installData
     * @param ConfigBasedIntegrationManager $integrationManager
     */
    public function __construct(InstallData $installData, ConfigBasedIntegrationManager $integrationManager)
    {
        $this->installData = $installData;
        $this->integrationManager = $integrationManager;
    }

    /**
     * @inheritdoc
     */
    public function apply(ModuleContextInterface $context)
    {
        $this->installData->install(null, $context);
        $this->integrationManager->processIntegrationConfig(['SaleswarpShip']);
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
}
