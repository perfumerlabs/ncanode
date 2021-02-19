<?php

namespace Ncanode\Model\Map;

use Ncanode\Model\Signature;
use Ncanode\Model\SignatureQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'ncanode_signature' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SignatureTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.SignatureTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'ncanode';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'ncanode_signature';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Ncanode\\Model\\Signature';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Signature';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the id field
     */
    const COL_ID = 'ncanode_signature.id';

    /**
     * the column name for the document field
     */
    const COL_DOCUMENT = 'ncanode_signature.document';

    /**
     * the column name for the chain field
     */
    const COL_CHAIN = 'ncanode_signature.chain';

    /**
     * the column name for the stage field
     */
    const COL_STAGE = 'ncanode_signature.stage';

    /**
     * the column name for the parent_id field
     */
    const COL_PARENT_ID = 'ncanode_signature.parent_id';

    /**
     * the column name for the signature field
     */
    const COL_SIGNATURE = 'ncanode_signature.signature';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'ncanode_signature.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'ncanode_signature.updated_at';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'Document', 'Chain', 'Stage', 'ParentId', 'Signature', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('id', 'document', 'chain', 'stage', 'parentId', 'signature', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(SignatureTableMap::COL_ID, SignatureTableMap::COL_DOCUMENT, SignatureTableMap::COL_CHAIN, SignatureTableMap::COL_STAGE, SignatureTableMap::COL_PARENT_ID, SignatureTableMap::COL_SIGNATURE, SignatureTableMap::COL_CREATED_AT, SignatureTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('id', 'document', 'chain', 'stage', 'parent_id', 'signature', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Document' => 1, 'Chain' => 2, 'Stage' => 3, 'ParentId' => 4, 'Signature' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'document' => 1, 'chain' => 2, 'stage' => 3, 'parentId' => 4, 'signature' => 5, 'createdAt' => 6, 'updatedAt' => 7, ),
        self::TYPE_COLNAME       => array(SignatureTableMap::COL_ID => 0, SignatureTableMap::COL_DOCUMENT => 1, SignatureTableMap::COL_CHAIN => 2, SignatureTableMap::COL_STAGE => 3, SignatureTableMap::COL_PARENT_ID => 4, SignatureTableMap::COL_SIGNATURE => 5, SignatureTableMap::COL_CREATED_AT => 6, SignatureTableMap::COL_UPDATED_AT => 7, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'document' => 1, 'chain' => 2, 'stage' => 3, 'parent_id' => 4, 'signature' => 5, 'created_at' => 6, 'updated_at' => 7, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [

        'Id' => 'ID',
        'Signature.Id' => 'ID',
        'id' => 'ID',
        'signature.id' => 'ID',
        'SignatureTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'id' => 'ID',
        'ncanode_signature.id' => 'ID',
        'Document' => 'DOCUMENT',
        'Signature.Document' => 'DOCUMENT',
        'document' => 'DOCUMENT',
        'signature.document' => 'DOCUMENT',
        'SignatureTableMap::COL_DOCUMENT' => 'DOCUMENT',
        'COL_DOCUMENT' => 'DOCUMENT',
        'document' => 'DOCUMENT',
        'ncanode_signature.document' => 'DOCUMENT',
        'Chain' => 'CHAIN',
        'Signature.Chain' => 'CHAIN',
        'chain' => 'CHAIN',
        'signature.chain' => 'CHAIN',
        'SignatureTableMap::COL_CHAIN' => 'CHAIN',
        'COL_CHAIN' => 'CHAIN',
        'chain' => 'CHAIN',
        'ncanode_signature.chain' => 'CHAIN',
        'Stage' => 'STAGE',
        'Signature.Stage' => 'STAGE',
        'stage' => 'STAGE',
        'signature.stage' => 'STAGE',
        'SignatureTableMap::COL_STAGE' => 'STAGE',
        'COL_STAGE' => 'STAGE',
        'stage' => 'STAGE',
        'ncanode_signature.stage' => 'STAGE',
        'ParentId' => 'PARENT_ID',
        'Signature.ParentId' => 'PARENT_ID',
        'parentId' => 'PARENT_ID',
        'signature.parentId' => 'PARENT_ID',
        'SignatureTableMap::COL_PARENT_ID' => 'PARENT_ID',
        'COL_PARENT_ID' => 'PARENT_ID',
        'parent_id' => 'PARENT_ID',
        'ncanode_signature.parent_id' => 'PARENT_ID',
        'Signature' => 'SIGNATURE',
        'Signature.Signature' => 'SIGNATURE',
        'signature' => 'SIGNATURE',
        'signature.signature' => 'SIGNATURE',
        'SignatureTableMap::COL_SIGNATURE' => 'SIGNATURE',
        'COL_SIGNATURE' => 'SIGNATURE',
        'signature' => 'SIGNATURE',
        'ncanode_signature.signature' => 'SIGNATURE',
        'CreatedAt' => 'CREATED_AT',
        'Signature.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'signature.createdAt' => 'CREATED_AT',
        'SignatureTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'ncanode_signature.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'Signature.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'signature.updatedAt' => 'UPDATED_AT',
        'SignatureTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'ncanode_signature.updated_at' => 'UPDATED_AT',
    ];

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('ncanode_signature');
        $this->setPhpName('Signature');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Ncanode\\Model\\Signature');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('ncanode_signature_id_seq');
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('document', 'Document', 'VARCHAR', true, 255, null);
        $this->addColumn('chain', 'Chain', 'VARCHAR', false, 255, null);
        $this->addColumn('stage', 'Stage', 'VARCHAR', false, 255, null);
        $this->addForeignKey('parent_id', 'ParentId', 'INTEGER', 'ncanode_signature', 'id', false, null, null);
        $this->addColumn('signature', 'Signature', 'LONGVARCHAR', true, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Parent', '\\Ncanode\\Model\\Signature', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':parent_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('SignatureRelatedById', '\\Ncanode\\Model\\Signature', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':parent_id',
    1 => ':id',
  ),
), null, null, 'SignaturesRelatedById', false);
        $this->addRelation('SignatureTag', '\\Ncanode\\Model\\SignatureTag', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':signature_id',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', 'SignatureTags', false);
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'timestampable' => array('create_column' => 'created_at', 'update_column' => 'updated_at', 'disable_created_at' => 'false', 'disable_updated_at' => 'false', ),
        );
    } // getBehaviors()
    /**
     * Method to invalidate the instance pool of all tables related to ncanode_signature     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        SignatureTagTableMap::clearInstancePool();
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? SignatureTableMap::CLASS_DEFAULT : SignatureTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Signature object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = SignatureTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SignatureTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SignatureTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SignatureTableMap::OM_CLASS;
            /** @var Signature $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SignatureTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = SignatureTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SignatureTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Signature $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SignatureTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(SignatureTableMap::COL_ID);
            $criteria->addSelectColumn(SignatureTableMap::COL_DOCUMENT);
            $criteria->addSelectColumn(SignatureTableMap::COL_CHAIN);
            $criteria->addSelectColumn(SignatureTableMap::COL_STAGE);
            $criteria->addSelectColumn(SignatureTableMap::COL_PARENT_ID);
            $criteria->addSelectColumn(SignatureTableMap::COL_SIGNATURE);
            $criteria->addSelectColumn(SignatureTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SignatureTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.document');
            $criteria->addSelectColumn($alias . '.chain');
            $criteria->addSelectColumn($alias . '.stage');
            $criteria->addSelectColumn($alias . '.parent_id');
            $criteria->addSelectColumn($alias . '.signature');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
        }
    }

    /**
     * Remove all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be removed as they are only loaded on demand.
     *
     * @param Criteria $criteria object containing the columns to remove.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function removeSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->removeSelectColumn(SignatureTableMap::COL_ID);
            $criteria->removeSelectColumn(SignatureTableMap::COL_DOCUMENT);
            $criteria->removeSelectColumn(SignatureTableMap::COL_CHAIN);
            $criteria->removeSelectColumn(SignatureTableMap::COL_STAGE);
            $criteria->removeSelectColumn(SignatureTableMap::COL_PARENT_ID);
            $criteria->removeSelectColumn(SignatureTableMap::COL_SIGNATURE);
            $criteria->removeSelectColumn(SignatureTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SignatureTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.document');
            $criteria->removeSelectColumn($alias . '.chain');
            $criteria->removeSelectColumn($alias . '.stage');
            $criteria->removeSelectColumn($alias . '.parent_id');
            $criteria->removeSelectColumn($alias . '.signature');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(SignatureTableMap::DATABASE_NAME)->getTable(SignatureTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(SignatureTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(SignatureTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new SignatureTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Signature or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Signature object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SignatureTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Ncanode\Model\Signature) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SignatureTableMap::DATABASE_NAME);
            $criteria->add(SignatureTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = SignatureQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SignatureTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SignatureTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the ncanode_signature table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return SignatureQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Signature or Criteria object.
     *
     * @param mixed               $criteria Criteria or Signature object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SignatureTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Signature object
        }

        if ($criteria->containsKey(SignatureTableMap::COL_ID) && $criteria->keyContainsValue(SignatureTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SignatureTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = SignatureQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // SignatureTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
SignatureTableMap::buildTableMap();
