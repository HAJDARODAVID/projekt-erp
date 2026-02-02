<?php

namespace App\Services\ConstructionSite;

/**
 * Class ConstructionSiteMaterialsInfoDto.
 */
class ConstructionSiteMaterialsInfoDto
{

    /**
     * Array of materials that are on stock on a specific construction site. 
     * 
     * @var array
     */
    private array $materialsOnStock = [];

    /**
     * The overall value in € for the materials on stock. 
     * 
     * @var float
     */
    private float $materialsOnStockValue = 0;

    /**
     * Array of materials that have been used on a specific construction site.
     * 
     * @var array
     */
    private array $consumedMaterials = [];

    /**
     * The overall value in € for the consumed materials. 
     * 
     * @var float
     */
    private float $consumedMaterialsValue = 0;

    /**
     * Get array of materials that are on stock on a specific construction site.
     *
     * @return  array
     */
    public function getMaterialsOnStock()
    {
        return $this->materialsOnStock;
    }

    /**
     * Set array of materials that are on stock on a specific construction site.
     *
     * @param  array  $materialsOnStock  Array of materials that are on stock on a specific construction site.
     *
     * @return  self
     */
    public function setMaterialsOnStock(array $materialsOnStock)
    {
        $this->materialsOnStock = $materialsOnStock;

        return $this;
    }

    /**
     * Get the overall value in € for the materials on stock.
     *
     * @return  float
     */
    public function getMaterialsOnStockValue()
    {
        return $this->materialsOnStockValue;
    }

    /**
     * Set the overall value in € for the materials on stock.
     *
     * @param  float  $materialsOnStockValue  The overall value in € for the materials on stock.
     *
     * @return  self
     */
    public function setMaterialsOnStockValue(float $materialsOnStockValue)
    {
        $this->materialsOnStockValue = $materialsOnStockValue;

        return $this;
    }

    /**
     * Get array of materials that have been used on a specific construction site.
     *
     * @return  array
     */
    public function getConsumedMaterials()
    {
        return $this->consumedMaterials;
    }

    /**
     * Set array of materials that have been used on a specific construction site.
     *
     * @param  array  $consumedMaterials  Array of materials that have been used on a specific construction site.
     *
     * @return  self
     */
    public function setConsumedMaterials(array $consumedMaterials)
    {
        $this->consumedMaterials = $consumedMaterials;

        return $this;
    }

    /**
     * Get the overall value in € for the consumed materials.
     *
     * @return  float
     */
    public function getConsumedMaterialsValue()
    {
        return $this->consumedMaterialsValue;
    }

    /**
     * Set the overall value in € for the consumed materials.
     *
     * @param  float  $consumedMaterialsValue  The overall value in € for the consumed materials.
     *
     * @return  self
     */
    public function setConsumedMaterialsValue(float $consumedMaterialsValue)
    {
        $this->consumedMaterialsValue = $consumedMaterialsValue;

        return $this;
    }
}
