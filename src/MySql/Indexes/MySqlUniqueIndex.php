<?php

namespace Squille\Cave\MySql\Indexes;

use PDO;
use Squille\Cave\Models\IIndexModel;
use Squille\Cave\UnconformitiesList;

class MySqlUniqueIndex extends AbstractMySqlIndex
{
    private $pdo;
    private $name;
    private $type;

    public function __construct(PDO $pdo, array $keyParts)
    {
        $this->pdo = $pdo;

        $this->name = $keyParts[0]->getKeyName();
        $this->type = $keyParts[0]->getIndexType();

        parent::__construct($keyParts);
    }

    public function checkIntegrity(IIndexModel $indexModel)
    {
        return new UnconformitiesList();
    }

    public function __toString()
    {
        return sprintf("UNIQUE KEY %s USING %s (%s)", $this->name, $this->type, parent::__toString());
    }
}