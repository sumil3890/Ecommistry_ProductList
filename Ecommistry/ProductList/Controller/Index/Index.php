<?php
/**
 * Customer Product list.
 *
 * @category  Ecommistry
 * @package   Ecommistry_ProductList
 * @author    Sumil
 * 
 */
namespace Ecommistry\ProductList\Controller\Index;
use Magento\Framework\App\RequestInterface;

class Index extends \Magento\Framework\App\Action\Action {

    protected $resultPageFactory;

    protected $customerSession;
    /** @var  \Magento\Catalog\Model\ResourceModel\Product\Collection */
    protected $productCollection;
    /**
     * Constructor
     *
     * @param \Magento\Framework\App\Action\Context  $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $collectionFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;        
        parent::__construct($context);
        $this->productCollection = $collectionFactory->create();
        $this->customerSession = $customerSession;
    }

    /**
     * Execute view action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute() {
        return $this->resultPageFactory->create();
    }


    public function dispatch(RequestInterface $request) {
        if (!$this->customerSession->authenticate()) {
            $this->_actionFlag->set('', self::FLAG_NO_DISPATCH, true);
        }
        return parent::dispatch($request);
     }
}