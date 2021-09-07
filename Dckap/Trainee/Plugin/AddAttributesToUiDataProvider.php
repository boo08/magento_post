<?php
namespace Dckap\Trainee\Plugin;

use Dckap\Trainee\Ui\DataProvider\Booking\ListingDataProvider as BookingDataProvider;
use Magento\Eav\Api\AttributeRepositoryInterface;
use Magento\Framework\App\ProductMetadataInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;

class AddAttributesToUiDataProvider
{
    /** @var AttributeRepositoryInterface */
    private $attributeRepository;

    /** @var ProductMetadataInterface */
    private $productMetadata;

    /**
     * Constructor
     *
     * @param \Magento\Eav\Api\AttributeRepositoryInterface $attributeRepository
     * @param \Magento\Framework\App\ProductMetadataInterface $productMetadata
     */
    public function __construct(
        AttributeRepositoryInterface $attributeRepository,
        ProductMetadataInterface $productMetadata
    ) {
        $this->attributeRepository = $attributeRepository;
        $this->productMetadata = $productMetadata;
    }

    /**
     * Get Search Result after plugin
     *
     * @param \Dckap\Trainee\Ui\DataProvider\Booking\ListingDataProvider $subject
     * @param \Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult $result
     * @return \Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult
     */
    public function afterGetSearchResult(BookingDataProvider $subject, SearchResult $result)
    {
        if ($result->isLoaded()) {
            return $result;
        }

        $edition = $this->productMetadata->getEdition();

        $column = 'entity_id';



//        $attribute = $this->attributeRepository->get('bookings', 'email');
//
//        $result->getSelect()->joinLeft(
//            ['email' => $attribute->getBackendTable()],
//            'email.' . $column . ' = main_table.' . $column . ' AND email.attribute_id = '
//            . $attribute->getAttributeId(),
//            ['email' => 'email.value']
//        );

        $result->getSelect()->where('email LIKE "B%"');

        return $result;
    }
}
