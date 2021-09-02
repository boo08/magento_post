<?php
namespace dckap\trainee\Controller\Index;

class Booking extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;
	protected $_Booking;
  protected $timezone;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
       \Magento\Framework\App\Action\Context $context,
       \Magento\Framework\View\Result\PageFactory $pageFactory,
       \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone,
       \dckap\trainee\Model\BookingFactory $Booking        
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->_Booking = $Booking;       
        $this->timezone = $timezone;
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
              // Retrieve your form data
              $todayDate = $this->timezone->date()->format('Y-m-d H:i:s');
              $params=[
                      "firstname"   => $post['firstname'],
                      "lastname"    => $post['lastname'],
                      "email"       => $post['email'],
                      "telephone"       => $post['telephone'],
                      "dob"       => $post['dob'],
                      "created_at"=>$todayDate,
                      "updated_at"=>$todayDate
                    ];
   
            $model = $this->_Booking->create();
            $model->addData($params);
            $saveData = $model->save();
            if($saveData){
              // Display the succes form validation message
              $this->messageManager->addSuccessMessage('Booking done !');
            }           
           
            $resultRedirect = $this->resultRedirectFactory->create();
            $resultRedirect->setPath('customer/index/bookinglist');
            return $resultRedirect;
            
          }
          // 2. GET request : Render the booking page 
          $this->_view->loadLayout();
          $this->_view->renderLayout();
    }
}
