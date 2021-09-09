<?php
namespace Dckap\Trainee\ViewModel;

class BookingShow implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    /**
     * @param array $data
     */
    protected $_bookingCollection;

    public function __construct(
        \Dckap\Trainee\Model\BookingFactory $Booking
    ) {
        $this->_bookingCollection = $Booking;
    }
    public function getBookings()
    {
        return $this->_bookingCollection->create()->getCollection();
    }

}
