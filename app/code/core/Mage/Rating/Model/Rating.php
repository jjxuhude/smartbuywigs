<?php

class Mage_Rating_Model_Rating extends Mage_Core_Model_Abstract
{
    /**
     * rating entity codes
     *
     */
    const ENTITY_PRODUCT_CODE           = 'product';
    const ENTITY_PRODUCT_REVIEW_CODE    = 'product_review';
    const ENTITY_REVIEW_CODE            = 'review';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('rating/rating');
    }

    public function addOptionVote($optionId, $entityPkValue)
    {
        Mage::getModel('rating/rating_option')->setOptionId($optionId)
            ->setRatingId($this->getId())
            ->setReviewId($this->getReviewId())
            ->setEntityPkValue($entityPkValue)
            ->addVote();
        return $this;
    }

    public function updateOptionVote($optionId)
    {
        Mage::getModel('rating/rating_option')->setOptionId($optionId)
            ->setVoteId($this->getVoteId())
            ->setReviewId($this->getReviewId())
            ->setDoUpdate(1)
            ->addVote();
        return $this;
    }

    /**
     * retrieve rating options
     *
     * @return array
     */
    public function getOptions()
    {
        if ($options = $this->getData('options')) {
            return $options;
        }
        elseif ($id = $this->getId()) {
            return Mage::getResourceModel('rating/rating_option_collection')
               ->addRatingFilter($id)
               ->setPositionOrder()
               ->load()
               ->getItems();
        }
        return array();
    }

    /**
     * Get rating collection object
     *
     * @return Varien_Data_Collection_Db
     */

    public function getEntitySummary($entityPkValue,  $onlyForCurrentStore = true)
    {
        $this->setEntityPkValue($entityPkValue);
        return $this->_getResource()->getEntitySummary($this, $onlyForCurrentStore);
    }

    public function getReviewSummary($reviewId,  $onlyForCurrentStore = true)
    {
        $this->setReviewId($reviewId);
        return $this->_getResource()->getReviewSummary($this, $onlyForCurrentStore);
    }

    /**
     * Get rating entity type id by code
     *
     * @param string $entityCode
     * @return int
     */
    public function getEntityIdByCode($entityCode)
    {
        return $this->getResource()->getEntityIdByCode($entityCode);
    }
}
