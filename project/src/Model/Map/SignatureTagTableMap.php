<?php

namespace Ncanode\Model\Map;

use Ncanode\Model\SignatureTag;
use Ncanode\Model\SignatureTagQuery;
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
 * This class defines the structure of the 'ncanode_signature_tag' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SignatureTagTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.SignatureTagTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'ncanode';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'ncanode_signature_tag';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Ncanode\\Model\\SignatureTag';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'SignatureTag';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 4;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 4;

    /**
     * the column name for the signature_id field
     */
    const COL_SIGNATURE_ID = 'ncanode_signature_tag.signature_id';

    /**
     * the column name for the tag_id field
     */
    const COL_TAG_ID = 'ncanode_signature_tag.tag_id';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'ncanode_signature_tag.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'ncanode_signature_tag.updated_at';

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
        self::TYPE_PHPNAME       => array('SignatureId', 'TagId', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('signatureId', 'tagId', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(SignatureTagTableMap::COL_SIGNATURE_ID, SignatureTagTableMap::COL_TAG_ID, SignatureTagTableMap::COL_CREATED_AT, SignatureTagTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('signature_id', 'tag_id', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('SignatureId' => 0, 'TagId' => 1, 'CreatedAt' => 2, 'UpdatedAt' => 3, ),
        self::TYPE_CAMELNAME     => array('signatureId' => 0, 'tagId' => 1, 'createdAt' => 2, 'updatedAt' => 3, ),
        self::TYPE_COLNAME       => array(SignatureTagTableMap::COL_SIGNATURE_ID => 0, SignatureTagTableMap::COL_TAG_ID => 1, SignatureTagTableMap::COL_CREATED_AT => 2, SignatureTagTableMap::COL_UPDATED_AT => 3, ),
        self::TYPE_FIELDNAME     => array('signature_id' => 0, 'tag_id' => 1, 'created_at' => 2, 'updated_at' => 3, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [

        'SignatureId' => 'SIGNATURE_ID',
        'SignatureTag.SignatureId' => 'SIGNATURE_ID',
        'signatureId' => 'SIGNATURE_ID',
        'signatureTag.signatureId' => 'SIGNATURE_ID',
        'SignatureTagTableMap::COL_SIGNATURE_ID' => 'SIGNATURE_ID',
        'COL_SIGNATURE_ID' => 'SIGNATURE_ID',
        'signature_id' => 'SIGNATURE_ID',
        'ncanode_signature_tag.signature_id' => 'SIGNATURE_ID',
        'TagId' => 'TAG_ID',
        'SignatureTag.TagId' => 'TAG_ID',
        'tagId' => 'TAG_ID',
        'signatureTag.tagId' => 'TAG_ID',
        'SignatureTagTableMap::COL_TAG_ID' => 'TAG_ID',
        'COL_TAG_ID' => 'TAG_ID',
        'tag_id' => 'TAG_ID',
        'ncanode_signature_tag.tag_id' => 'TAG_ID',
        'CreatedAt' => 'CREATED_AT',
        'SignatureTag.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'signatureTag.createdAt' => 'CREATED_AT',
        'SignatureTagTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'ncanode_signature_tag.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SignatureTag.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'signatureTag.updatedAt' => 'UPDATED_AT',
        'SignatureTagTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'ncanode_signature_tag.updated_at' => 'UPDATED_AT',
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
        $this->setName('ncanode_signature_tag');
        $this->setPhpName('SignatureTag');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Ncanode\\Model\\SignatureTag');
        $this->setPackage('');
        $this->setUseIdGenerator(false);
        $this->setIsCrossRef(true);
        // columns
        $this->addForeignPrimaryKey('signature_id', 'SignatureId', 'INTEGER' , 'ncanode_signature', 'id', true, null, null);
        $this->addForeignPrimaryKey('tag_id', 'TagId', 'INTEGER' , 'ncanode_tag', 'id', true, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Signature', '\\Ncanode\\Model\\Signature', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':signature_id',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', null, false);
        $this->addRelation('Tag', '\\Ncanode\\Model\\Tag', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':tag_id',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', null, false);
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
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database. In some cases you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by find*()
     * and findPk*() calls.
     *
     * @param \Ncanode\Model\SignatureTag $obj A \Ncanode\Model\SignatureTag object.
     * @param string $key             (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (null === $key) {
                $key = serialize([(null === $obj->getSignatureId() || is_scalar($obj->getSignatureId()) || is_callable([$obj->getSignatureId(), '__toString']) ? (string) $obj->getSignatureId() : $obj->getSignatureId()), (null === $obj->getTagId() || is_scalar($obj->getTagId()) || is_callable([$obj->getTagId(), '__toString']) ? (string) $obj->getTagId() : $obj->getTagId())]);
            } // if key === null
            self::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param mixed $value A \Ncanode\Model\SignatureTag object or a primary key value.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \Ncanode\Model\SignatureTag) {
                $key = serialize([(null === $value->getSignatureId() || is_scalar($value->getSignatureId()) || is_callable([$value->getSignatureId(), '__toString']) ? (string) $value->getSignatureId() : $value->getSignatureId()), (null === $value->getTagId() || is_scalar($value->getTagId()) || is_callable([$value->getTagId(), '__toString']) ? (string) $value->getTagId() : $value->getTagId())]);

            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key";
                $key = serialize([(null === $value[0] || is_scalar($value[0]) || is_callable([$value[0], '__toString']) ? (string) $value[0] : $value[0]), (null === $value[1] || is_scalar($value[1]) || is_callable([$value[1], '__toString']) ? (string) $value[1] : $value[1])]);
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \Ncanode\Model\SignatureTag object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
                throw $e;
            }

            unset(self::$instances[$key]);
        }
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SignatureId', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('TagId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return serialize([(null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SignatureId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SignatureId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SignatureId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SignatureId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SignatureId', TableMap::TYPE_PHPNAME, $indexType)]), (null === $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('TagId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('TagId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('TagId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('TagId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('TagId', TableMap::TYPE_PHPNAME, $indexType)])]);
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
            $pks = [];

        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('SignatureId', TableMap::TYPE_PHPNAME, $indexType)
        ];
        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 1 + $offset
                : self::translateFieldName('TagId', TableMap::TYPE_PHPNAME, $indexType)
        ];

        return $pks;
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
        return $withPrefix ? SignatureTagTableMap::CLASS_DEFAULT : SignatureTagTableMap::OM_CLASS;
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
     * @return array           (SignatureTag object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = SignatureTagTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SignatureTagTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SignatureTagTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SignatureTagTableMap::OM_CLASS;
            /** @var SignatureTag $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SignatureTagTableMap::addInstanceToPool($obj, $key);
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
            $key = SignatureTagTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SignatureTagTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SignatureTag $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SignatureTagTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SignatureTagTableMap::COL_SIGNATURE_ID);
            $criteria->addSelectColumn(SignatureTagTableMap::COL_TAG_ID);
            $criteria->addSelectColumn(SignatureTagTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SignatureTagTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.signature_id');
            $criteria->addSelectColumn($alias . '.tag_id');
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
            $criteria->removeSelectColumn(SignatureTagTableMap::COL_SIGNATURE_ID);
            $criteria->removeSelectColumn(SignatureTagTableMap::COL_TAG_ID);
            $criteria->removeSelectColumn(SignatureTagTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SignatureTagTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.signature_id');
            $criteria->removeSelectColumn($alias . '.tag_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(SignatureTagTableMap::DATABASE_NAME)->getTable(SignatureTagTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(SignatureTagTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(SignatureTagTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new SignatureTagTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a SignatureTag or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or SignatureTag object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SignatureTagTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Ncanode\Model\SignatureTag) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SignatureTagTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = array($values);
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(SignatureTagTableMap::COL_SIGNATURE_ID, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(SignatureTagTableMap::COL_TAG_ID, $value[1]));
                $criteria->addOr($criterion);
            }
        }

        $query = SignatureTagQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SignatureTagTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SignatureTagTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the ncanode_signature_tag table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return SignatureTagQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SignatureTag or Criteria object.
     *
     * @param mixed               $criteria Criteria or SignatureTag object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SignatureTagTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SignatureTag object
        }


        // Set the correct dbName
        $query = SignatureTagQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // SignatureTagTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
SignatureTagTableMap::buildTableMap();
