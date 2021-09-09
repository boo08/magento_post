<?php
namespace Dckap\Trainee\Controller\Index;

use Dckap\Trainee\Model\BookingFactory;
use Dckap\Trainee\Model\ResourceModel\Booking;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;

class Edit extends \Magento\Framework\App\Action\Action
{
    /**
     * @var PageFactory
     */
    protected $_pageFactory;
    protected $booking;
    protected $_request;
    protected $timezone;
    /**
     * @var BookingFactory
     */
    private $bookingFactory;

    /**
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param BookingFactory $bookingFactory
     * @param Booking $booking
     * @param Http $request
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        BookingFactory $bookingFactory,
        Booking $booking,
        Http $request
    ) {
        $this->booking = $booking;
        $this->bookingFactory = $bookingFactory;
        $this->_request = $request;
        $this->_pageFactory = $pageFactory;
        return parent::__construct($context);
    }

    /**
     * View page action
     *
     * @return ResultInterface
     * @throws \Exception
     */
    public function execute()
    {
        $post = (array) $this->getRequest()->getPost();
        if (!empty($post)) {
            $id = $this->_request->getParam('id');

            $params=[
                    "firstname"   => $post['firstname'],
                    "lastname"    => $post['lastname'],
                    "email"       => $post['email'],
                    "telephone"   => $post['telephone'],
                    "dob"       => $post['dob']
                ];
            $model = $this->bookingFactory->create()->setData($params);
            $model->setEntityId($id);
            $saveData = $this->booking->save($model);
            if ($saveData) {
                $this->messageManager->addSuccessMessage('Booking Updated done !');
            }

            $resultRedirect = $this->resultRedirectFactory->create();
            $resultRedirect->setPath('booking/index/show');
            return $resultRedirect;
        }

        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }
}
