<?php
namespace Dckap\Trainee\ViewModel;

use Dckap\Trainee\Model\BookingFactory;
use Dckap\Trainee\Model\ResourceModel\Booking;
use Magento\Framework\App\Request\Http;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class BookingEdit implements ArgumentInterface
{
    /**
     * @var BookingFactory
     */
    private $_bookingCollection;
    /**
     * @var Http
     */
    private $_request;
    /**
     * @var Booking
     */
    private $_booking;

    /**
     * @param BookingFactory $BookingFactory
     * @param Booking $Booking
     * @param Http $request
     */
    public function __construct(
        BookingFactory $BookingFactory,
        Booking $Booking,
        Http $request
    ) {
        $this->_bookingCollection = $BookingFactory;
        $this->_booking = $Booking;
        $this->_request = $request;
    }


    public function getBooking()
    {
        $id = $this->_request->getParam('id');

        $postData = $this->_bookingCollection->create();
        $result = $postData->load($id);
        $result = $result->getData();
        return $result;
    }
}
