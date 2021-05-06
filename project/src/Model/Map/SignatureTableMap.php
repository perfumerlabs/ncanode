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
    const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the id field
     */
    const COL_ID = 'ncanode_signature.id';

    /**
     * the column name for the document field
     */
    const COL_DOCUMENT = 'ncanode_signature.document';

    /**
     * the column name for the thread field
     */
    const COL_THREAD = 'ncanode_signature.thread';

    /**
     * the column name for the cms field
     */
    const COL_CMS = 'ncanode_signature.cms';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'ncanode_signature.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'ncanode_signature.updated_at';

    /**
     * the column name for the version field
     */
    const COL_VERSION = 'ncanode_signature.version';

    /**
     * the column name for the version_created_at field
     */
    const COL_VERSION_CREATED_AT = 'ncanode_signature.version_created_at';

    /**
     * the column name for the version_created_by field
     */
    const COL_VERSION_CREATED_BY = 'ncanode_signature.version_created_by';

    /**
     * the column name for the version_comment field
     */
    const COL_VERSION_COMMENT = 'ncanode_signature.version_comment';

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
        self::TYPE_PHPNAME       => array('Id', 'Document', 'Thread', 'Cms', 'CreatedAt', 'UpdatedAt', 'Version', 'VersionCreatedAt', 'VersionCreatedBy', 'VersionComment', ),
        self::TYPE_CAMELNAME     => array('id', 'document', 'thread', 'cms', 'createdAt', 'updatedAt', 'version', 'versionCreatedAt', 'versionCreatedBy', 'versionComment', ),
        self::TYPE_COLNAME       => array(SignatureTableMap::COL_ID, SignatureTableMap::COL_DOCUMENT, SignatureTableMap::COL_THREAD, SignatureTableMap::COL_CMS, SignatureTableMap::COL_CREATED_AT, SignatureTableMap::COL_UPDATED_AT, SignatureTableMap::COL_VERSION, SignatureTableMap::COL_VERSION_CREATED_AT, SignatureTableMap::COL_VERSION_CREATED_BY, SignatureTableMap::COL_VERSION_COMMENT, ),
        self::TYPE_FIELDNAME     => array('id', 'document', 'thread', 'cms', 'created_at', 'updated_at', 'version', 'version_created_at', 'version_created_by', 'version_comment', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Document' => 1, 'Thread' => 2, 'Cms' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, 'Version' => 6, 'VersionCreatedAt' => 7, 'VersionCreatedBy' => 8, 'VersionComment' => 9, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'document' => 1, 'thread' => 2, 'cms' => 3, 'createdAt' => 4, 'updatedAt' => 5, 'version' => 6, 'versionCreatedAt' => 7, 'versionCreatedBy' => 8, 'versionComment' => 9, ),
        self::TYPE_COLNAME       => array(SignatureTableMap::COL_ID => 0, SignatureTableMap::COL_DOCUMENT => 1, SignatureTableMap::COL_THREAD => 2, SignatureTableMap::COL_CMS => 3, SignatureTableMap::COL_CREATED_AT => 4, SignatureTableMap::COL_UPDATED_AT => 5, SignatureTableMap::COL_VERSION => 6, SignatureTableMap::COL_VERSION_CREATED_AT => 7, SignatureTableMap::COL_VERSION_CREATED_BY => 8, SignatureTableMap::COL_VERSION_COMMENT => 9, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'document' => 1, 'thread' => 2, 'cms' => 3, 'created_at' => 4, 'updated_at' => 5, 'version' => 6, 'version_created_at' => 7, 'version_created_by' => 8, 'version_comment' => 9, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
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
        'Thread' => 'THREAD',
        'Signature.Thread' => 'THREAD',
        'thread' => 'THREAD',
        'signature.thread' => 'THREAD',
        'SignatureTableMap::COL_THREAD' => 'THREAD',
        'COL_THREAD' => 'THREAD',
        'thread' => 'THREAD',
        'ncanode_signature.thread' => 'THREAD',
        'Cms' => 'CMS',
        'Signature.Cms' => 'CMS',
        'cms' => 'CMS',
        'signature.cms' => 'CMS',
        'SignatureTableMap::COL_CMS' => 'CMS',
        'COL_CMS' => 'CMS',
        'cms' => 'CMS',
        'ncanode_signature.cms' => 'CMS',
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
        'Version' => 'VERSION',
        'Signature.Version' => 'VERSION',
        'version' => 'VERSION',
        'signature.version' => 'VERSION',
        'SignatureTableMap::COL_VERSION' => 'VERSION',
        'COL_VERSION' => 'VERSION',
        'version' => 'VERSION',
        'ncanode_signature.version' => 'VERSION',
        'VersionCreatedAt' => 'VERSION_CREATED_AT',
        'Signature.VersionCreatedAt' => 'VERSION_CREATED_AT',
        'versionCreatedAt' => 'VERSION_CREATED_AT',
        'signature.versionCreatedAt' => 'VERSION_CREATED_AT',
        'SignatureTableMap::COL_VERSION_CREATED_AT' => 'VERSION_CREATED_AT',
        'COL_VERSION_CREATED_AT' => 'VERSION_CREATED_AT',
        'version_created_at' => 'VERSION_CREATED_AT',
        'ncanode_signature.version_created_at' => 'VERSION_CREATED_AT',
        'VersionCreatedBy' => 'VERSION_CREATED_BY',
        'Signature.VersionCreatedBy' => 'VERSION_CREATED_BY',
        'versionCreatedBy' => 'VERSION_CREATED_BY',
        'signature.versionCreatedBy' => 'VERSION_CREATED_BY',
        'SignatureTableMap::COL_VERSION_CREATED_BY' => 'VERSION_CREATED_BY',
        'COL_VERSION_CREATED_BY' => 'VERSION_CREATED_BY',
        'version_created_by' => 'VERSION_CREATED_BY',
        'ncanode_signature.version_created_by' => 'VERSION_CREATED_BY',
        'VersionComment' => 'VERSION_COMMENT',
        'Signature.VersionComment' => 'VERSION_COMMENT',
        'versionComment' => 'VERSION_COMMENT',
        'signature.versionComment' => 'VERSION_COMMENT',
        'SignatureTableMap::COL_VERSION_COMMENT' => 'VERSION_COMMENT',
        'COL_VERSION_COMMENT' => 'VERSION_COMMENT',
        'version_comment' => 'VERSION_COMMENT',
        'ncanode_signature.version_comment' => 'VERSION_COMMENT',
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
        $this->addColumn('thread', 'Thread', 'VARCHAR', true, 255, null);
        $this->addColumn('cms', 'Cms', 'LONGVARCHAR', true, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('version', 'Version', 'INTEGER', false, null, 0);
        $this->addColumn('version_created_at', 'VersionCreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('version_created_by', 'VersionCreatedBy', 'VARCHAR', false, 100, null);
        $this->addColumn('version_comment', 'VersionComment', 'VARCHAR', false, 255, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('SignatureTag', '\\Ncanode\\Model\\SignatureTag', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':signature_id',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', 'SignatureTags', false);
        $this->addRelation('SignatureVersion', '\\Ncanode\\Model\\SignatureVersion', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id',
    1 => ':id',
  ),
), 'CASCADE', null, 'SignatureVersions', false);
        $this->addRelation('Tag', '\\Ncanode\\Model\\Tag', RelationMap::MANY_TO_MANY, array(), 'CASCADE', 'CASCADE', 'Tags');
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
            'versionable' => array('version_column' => 'version', 'version_table' => '', 'log_created_at' => 'true', 'log_created_by' => 'true', 'log_comment' => 'true', 'version_created_at_column' => 'version_created_at', 'version_created_by_column' => 'version_created_by', 'version_comment_column' => 'version_comment', 'indices' => 'false', ),
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
        SignatureVersionTableMap::clearInstancePool();
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
            $criteria->addSelectColumn(SignatureTableMap::COL_THREAD);
            $criteria->addSelectColumn(SignatureTableMap::COL_CMS);
            $criteria->addSelectColumn(SignatureTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SignatureTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(SignatureTableMap::COL_VERSION);
            $criteria->addSelectColumn(SignatureTableMap::COL_VERSION_CREATED_AT);
            $criteria->addSelectColumn(SignatureTableMap::COL_VERSION_CREATED_BY);
            $criteria->addSelectColumn(SignatureTableMap::COL_VERSION_COMMENT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.document');
            $criteria->addSelectColumn($alias . '.thread');
            $criteria->addSelectColumn($alias . '.cms');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.version');
            $criteria->addSelectColumn($alias . '.version_created_at');
            $criteria->addSelectColumn($alias . '.version_created_by');
            $criteria->addSelectColumn($alias . '.version_comment');
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
            $criteria->removeSelectColumn(SignatureTableMap::COL_THREAD);
            $criteria->removeSelectColumn(SignatureTableMap::COL_CMS);
            $criteria->removeSelectColumn(SignatureTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SignatureTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(SignatureTableMap::COL_VERSION);
            $criteria->removeSelectColumn(SignatureTableMap::COL_VERSION_CREATED_AT);
            $criteria->removeSelectColumn(SignatureTableMap::COL_VERSION_CREATED_BY);
            $criteria->removeSelectColumn(SignatureTableMap::COL_VERSION_COMMENT);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.document');
            $criteria->removeSelectColumn($alias . '.thread');
            $criteria->removeSelectColumn($alias . '.cms');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.version');
            $criteria->removeSelectColumn($alias . '.version_created_at');
            $criteria->removeSelectColumn($alias . '.version_created_by');
            $criteria->removeSelectColumn($alias . '.version_comment');
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
