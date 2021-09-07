<?php
namespace Dckap\Trainee\Controller\Index;

class Edit extends \Magento\Framework\App\Action\Action
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
       \Dckap\Trainee\Model\BookingFactory $Booking,                 \Magento\Framework\App\Request\Http $request
    )
    {
        $this->_booking = $Booking;  
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
            $id = $this->_request->getParam('id');
        
            $params=[
                    "firstname"   => $post['firstname'],
                    "lastname"    => $post['lastname'],
                    "email"       => $post['email'],
                    "telephone"   => $post['telephone'],
                    "dob"       => $post['dob']
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
              $resultRedirect->setPath('booking/index/show');
              return $resultRedirect;
        }
 
        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }
}
