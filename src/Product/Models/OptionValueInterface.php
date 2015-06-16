<?php
namespace ANavallaSuiza\Ecommerce\Product\Models;

interface OptionValueInterface
{
    /**
     * Get option.
     *
     * @return OptionInterface
     */
    public function getOption();

    /**
     * Set option.
     *
     * @param OptionInterface $option
     */
    public function setOption(OptionInterface $option);
}
