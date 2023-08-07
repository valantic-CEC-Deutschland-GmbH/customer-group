<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\CustomerGroup\Business\Model;

use Generated\Shared\Transfer\CustomerGroupTransfer;
use Orm\Zed\CustomerGroup\Persistence\SpyCustomerGroupToCustomer;
use Spryker\Zed\CustomerGroup\Business\Model\CustomerGroup as SprykerCustomerGroup;
use Spryker\Zed\CustomerGroup\Persistence\CustomerGroupQueryContainerInterface;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

class CustomerGroup extends SprykerCustomerGroup
{
    use TransactionTrait;

    /**
     * @var \Spryker\Zed\CustomerGroup\Persistence\CustomerGroupQueryContainerInterface
     */
    protected $queryContainer;

    /**
     * @param \Spryker\Zed\CustomerGroup\Persistence\CustomerGroupQueryContainerInterface $queryContainer
     * @param array<\ValanticSpryker\Zed\CustomerGroup\Dependency\Plugin\CustomerGroupDeleteEventPluginInterface> $customerGroupDeleteEventPlugins
     */
    public function __construct(CustomerGroupQueryContainerInterface $queryContainer, private array $customerGroupDeleteEventPlugins = [])
    {
        parent::__construct($queryContainer);
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerGroupTransfer $customerGroupTransfer
     *
     * @return bool
     */
    public function delete(CustomerGroupTransfer $customerGroupTransfer): bool
    {
        $customerGroupToCustomerEntities = $this->queryContainer
            ->queryCustomerGroupToCustomerByFkCustomerGroup($customerGroupTransfer->getIdCustomerGroup())
            ->find();

        parent::delete($customerGroupTransfer);

        foreach ($customerGroupToCustomerEntities as $customerGroupToCustomerEntity) {
            $this->raiseDeleteEvent($customerGroupToCustomerEntity);
        }

        return true;
    }

    /**
     * @param \Orm\Zed\CustomerGroup\Persistence\SpyCustomerGroupToCustomer $spyCustomerGroupToCustomer
     *
     * @return void
     */
    private function raiseDeleteEvent(SpyCustomerGroupToCustomer $spyCustomerGroupToCustomer): void
    {
        foreach ($this->customerGroupDeleteEventPlugins as $eventPlugin) {
            $eventPlugin->raiseEvent($spyCustomerGroupToCustomer);
        }
    }
}
