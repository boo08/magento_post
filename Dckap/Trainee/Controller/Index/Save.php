<?php
namespace Dckap\Trainee\Controller\Index;

use Dckap\Trainee\Model\BookingFactory;
use Dckap\Trainee\Model\ResourceModel\Booking;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\View\Result\PageFactory;

class Save extends Action
{
    /**
     * @var PageFactory
     */
    protected $_pageFactory;
    protected $_Booking;
    protected $timezone;
    /**
     * @var BookingFactory
     */
    private $_BookingFactory;

    /**
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param BookingFactory $BookingFactory
     * @param Booking $Booking
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        BookingFactory $BookingFactory,
        Booking $Booking
    ) {
        $this->_pageFactory = $pageFactory;
        $this->_BookingFactory = $BookingFactory;
        $this->_Booking = $Booking;
        return parent::__construct($context);
    }

    /**
     * View page action
     *
     * @return ResultInterface
     * @throws AlreadyExistsException
     */
    public function execute()
    {
        $post = (array) $this->getRequest()->getPost();
        if (!empty($post)) {
            $params=[
                      "firstname"   => $post['firstname'],
                      "lastname"    => $post['lastname'],
                      "email"       => $post['email'],
                      "telephone"       => $post['telephone'],
                      "dob"       => $post['dob'],
                    ];

            $model = $this->_BookingFactory->create()->setData($params);
            $saveData = $this->_Booking->save($model);
            if ($saveData) {
                // Display the succes form validation message
                $this->messageManager->addSuccessMessage('Booking done !');
            }

            $resultRedirect = $this->resultRedirectFactory->create();
            $resultRedirect->setPath('booking/index/show');
            return $resultRedirect;
        }
        // 2. GET request : Render the booking page
        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }
}
