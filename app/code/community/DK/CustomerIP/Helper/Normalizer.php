<?php
/*
 * This file is part of the DK_CustomerIP package.
 *
 * (c) Dmitry Kazak <dmitry.kazak0@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
