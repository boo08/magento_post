<?php
namespace dckap\trainee\Controller\Index;

class Bookingedit extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;
	protected $_booking;
    protected $_request;
    protected $timezone;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
       \Magento\Framework\App\Action\Context $context,
       \Magento\Framework\View\Result\PageFactory $pageFactory,
       \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone,
       \dckap\trainee\Model\BookingFactory $Booking,                 \Magento\Framework\App\Request\Http $request
    )
    {
        $this->_booking = $Booking;  
        $this->timezone = $timezone;
        $this->_request = $request;     
        $this->_pageFactory = $pageFactory;
        return parent::__construct($context);
    }
    /**
     * View page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $post = (array) $this->getRequest()->getPost();
        if (!empty($post)) {
            $todayDate = $this->timezone->date()->format('Y-m-d H:i:s');

            $id = $this->_request->getParam('id');
        
            $params=[
                    "firstname"   => $post['firstname'],
                    "lastname"    => $post['lastname'],
                    "email"       => $post['email'],
                    "telephone"   => $post['telephone'],
                    "dob"       => $post['dob'],
                    "updated_at"=>$todayDate
                ];
    
            $model = $this->_booking->create();
            $saveData =$model->load($id);
            $saveData =$model->addData($params);
            $saveData =$model->setId($id);
            $saveData =$model->save();
            if($saveData){
                $this->messageManager->addSuccessMessage('Booking Updated done !');
            }
        
             
              $resultRedirect = $this->resultRedirectFactory->create();
              $resultRedirect->setPath('customer/index/bookinglist');
              return $resultRedirect;
        }
 
        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }
}
