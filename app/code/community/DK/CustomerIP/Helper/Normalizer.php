<?php

class DK_CustomerIP_Helper_Normalizer extends Mage_Core_Helper_Abstract
{
    /**
     * @var array
     */
    protected $skipValues = [
        true,
        false,
        '',
        ' ',
    ];

    /**
     * @param array $data
     *
     * @return string
     */
    public function normalize(array $data)
    {
        $normalizerData = [];
        foreach ($data as $name => $value) {
            if (!in_array($value, $this->skipValues, true)) {
                $normalizerField = ucfirst(str_replace('_', ' ', $name));
                $normalizerData[$normalizerField] = $value;
            }
        }

        return Zend_Json_Encoder::encode($normalizerData);
    }
}
