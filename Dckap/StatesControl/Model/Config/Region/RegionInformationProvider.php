<?php

namespace Dckap\StatesControl\Model\Config\Region;

class RegionInformationProvider
{
    protected $countryInformationAcquirer;
    protected $addressRepository;

    public function __construct(
        \Magento\Directory\Api\CountryInformationAcquirerInterface $countryInformationAcquirer
    ) {
        $this->countryInformationAcquirer = $countryInformationAcquirer;
    }

    public function toOptionArray()
    {
        $regions = [];
        $countries = $this->countryInformationAcquirer->getCountriesInfo();
        foreach ($countries as $country) {
            if ($country->getId() == 'US') {
                if ($availableRegions = $country->getAvailableRegions()) {
                    foreach ($availableRegions as $region) {
                        $regions[] = [
                            'value' => $region->getId(),
                            'label' => $region->getName()
                        ];
                    }
                }
            }
        }
        return $regions;
    }
}
