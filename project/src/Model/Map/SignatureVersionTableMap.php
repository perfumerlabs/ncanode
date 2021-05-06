<?php

namespace Ncanode\Model\Map;

use Ncanode\Model\SignatureVersion;
use Ncanode\Model\SignatureVersionQuery;
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
 * This class defines the structure of the 'ncanode_signature_version' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SignatureVersionTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.SignatureVersionTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'ncanode';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'ncanode_signature_version';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Ncanode\\Model\\SignatureVersion';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'SignatureVersion';

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
    const COL_ID = 'ncanode_signature_version.id';

    /**
     * the column name for the document field
     */
    const COL_DOCUMENT = 'ncanode_signature_version.document';

    /**
     * the column name for the thread field
     */
    const COL_THREAD = 'ncanode_signature_version.thread';

    /**
     * the column name for the cms field
     */
    const COL_CMS = 'ncanode_signature_version.cms';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'ncanode_signature_version.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'ncanode_signature_version.updated_at';

    /**
     * the column name for the version field
     */
    const COL_VERSION = 'ncanode_signature_version.version';

    /**
     * the column name for the version_created_at field
     */
    const COL_VERSION_CREATED_AT = 'ncanode_signature_version.version_created_at';

    /**
     * the column name for the version_created_by field
     */
    const COL_VERSION_CREATED_BY = 'ncanode_signature_version.version_created_by';

    /**
     * the column name for the version_comment field
     */
    const COL_VERSION_COMMENT = 'ncanode_signature_version.version_comment';

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
        self::TYPE_COLNAME       => array(SignatureVersionTableMap::COL_ID, SignatureVersionTableMap::COL_DOCUMENT, SignatureVersionTableMap::COL_THREAD, SignatureVersionTableMap::COL_CMS, SignatureVersionTableMap::COL_CREATED_AT, SignatureVersionTableMap::COL_UPDATED_AT, SignatureVersionTableMap::COL_VERSION, SignatureVersionTableMap::COL_VERSION_CREATED_AT, SignatureVersionTableMap::COL_VERSION_CREATED_BY, SignatureVersionTableMap::COL_VERSION_COMMENT, ),
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
        self::TYPE_COLNAME       => array(SignatureVersionTableMap::COL_ID => 0, SignatureVersionTableMap::COL_DOCUMENT => 1, SignatureVersionTableMap::COL_THREAD => 2, SignatureVersionTableMap::COL_CMS => 3, SignatureVersionTableMap::COL_CREATED_AT => 4, SignatureVersionTableMap::COL_UPDATED_AT => 5, SignatureVersionTableMap::COL_VERSION => 6, SignatureVersionTableMap::COL_VERSION_CREATED_AT => 7, SignatureVersionTableMap::COL_VERSION_CREATED_BY => 8, SignatureVersionTableMap::COL_VERSION_COMMENT => 9, ),
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
        'SignatureVersion.Id' => 'ID',
        'id' => 'ID',
        'signatureVersion.id' => 'ID',
        'SignatureVersionTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'id' => 'ID',
        'ncanode_signature_version.id' => 'ID',
        'Document' => 'DOCUMENT',
        'SignatureVersion.Document' => 'DOCUMENT',
        'document' => 'DOCUMENT',
        'signatureVersion.document' => 'DOCUMENT',
        'SignatureVersionTableMap::COL_DOCUMENT' => 'DOCUMENT',
        'COL_DOCUMENT' => 'DOCUMENT',
        'document' => 'DOCUMENT',
        'ncanode_signature_version.document' => 'DOCUMENT',
        'Thread' => 'THREAD',
        'SignatureVersion.Thread' => 'THREAD',
        'thread' => 'THREAD',
        'signatureVersion.thread' => 'THREAD',
        'SignatureVersionTableMap::COL_THREAD' => 'THREAD',
        'COL_THREAD' => 'THREAD',
        'thread' => 'THREAD',
        'ncanode_signature_version.thread' => 'THREAD',
        'Cms' => 'CMS',
        'SignatureVersion.Cms' => 'CMS',
        'cms' => 'CMS',
        'signatureVersion.cms' => 'CMS',
        'SignatureVersionTableMap::COL_CMS' => 'CMS',
        'COL_CMS' => 'CMS',
        'cms' => 'CMS',
        'ncanode_signature_version.cms' => 'CMS',
        'CreatedAt' => 'CREATED_AT',
        'SignatureVersion.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'signatureVersion.createdAt' => 'CREATED_AT',
        'SignatureVersionTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'ncanode_signature_version.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SignatureVersion.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'signatureVersion.updatedAt' => 'UPDATED_AT',
        'SignatureVersionTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'ncanode_signature_version.updated_at' => 'UPDATED_AT',
        'Version' => 'VERSION',
        'SignatureVersion.Version' => 'VERSION',
        'version' => 'VERSION',
        'signatureVersion.version' => 'VERSION',
        'SignatureVersionTableMap::COL_VERSION' => 'VERSION',
        'COL_VERSION' => 'VERSION',
        'version' => 'VERSION',
        'ncanode_signature_version.version' => 'VERSION',
        'VersionCreatedAt' => 'VERSION_CREATED_AT',
        'SignatureVersion.VersionCreatedAt' => 'VERSION_CREATED_AT',
        'versionCreatedAt' => 'VERSION_CREATED_AT',
        'signatureVersion.versionCreatedAt' => 'VERSION_CREATED_AT',
        'SignatureVersionTableMap::COL_VERSION_CREATED_AT' => 'VERSION_CREATED_AT',
        'COL_VERSION_CREATED_AT' => 'VERSION_CREATED_AT',
        'version_created_at' => 'VERSION_CREATED_AT',
        'ncanode_signature_version.version_created_at' => 'VERSION_CREATED_AT',
        'VersionCreatedBy' => 'VERSION_CREATED_BY',
        'SignatureVersion.VersionCreatedBy' => 'VERSION_CREATED_BY',
        'versionCreatedBy' => 'VERSION_CREATED_BY',
        'signatureVersion.versionCreatedBy' => 'VERSION_CREATED_BY',
        'SignatureVersionTableMap::COL_VERSION_CREATED_BY' => 'VERSION_CREATED_BY',
        'COL_VERSION_CREATED_BY' => 'VERSION_CREATED_BY',
        'version_created_by' => 'VERSION_CREATED_BY',
        'ncanode_signature_version.version_created_by' => 'VERSION_CREATED_BY',
        'VersionComment' => 'VERSION_COMMENT',
        'SignatureVersion.VersionComment' => 'VERSION_COMMENT',
        'versionComment' => 'VERSION_COMMENT',
        'signatureVersion.versionComment' => 'VERSION_COMMENT',
        'SignatureVersionTableMap::COL_VERSION_COMMENT' => 'VERSION_COMMENT',
        'COL_VERSION_COMMENT' => 'VERSION_COMMENT',
        'version_comment' => 'VERSION_COMMENT',
        'ncanode_signature_version.version_comment' => 'VERSION_COMMENT',
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
        $this->setName('ncanode_signature_version');
        $this->setPhpName('SignatureVersion');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Ncanode\\Model\\SignatureVersion');
        $this->setPackage('');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('id', 'Id', 'INTEGER' , 'ncanode_signature', 'id', true, null, null);
        $this->addColumn('document', 'Document', 'VARCHAR', true, 255, null);
        $this->addColumn('thread', 'Thread', 'VARCHAR', true, 255, null);
        $this->addColumn('cms', 'Cms', 'LONGVARCHAR', true, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addPrimaryKey('version', 'Version', 'INTEGER', true, null, 0);
        $this->addColumn('version_created_at', 'VersionCreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('version_created_by', 'VersionCreatedBy', 'VARCHAR', false, 100, null);
        $this->addColumn('version_comment', 'VersionComment', 'VARCHAR', false, 255, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Signature', '\\Ncanode\\Model\\Signature', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id',
    1 => ':id',
  ),
), 'CASCADE', null, null, false);
    } // buildRelations()

    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database. In some cases you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by find*()
     * and findPk*() calls.
     *
     * @param \Ncanode\Model\SignatureVersion $obj A \Ncanode\Model\SignatureVersion object.
     * @param string $key             (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (null === $key) {
                $key = serialize([(null === $obj->getId() || is_scalar($obj->getId()) || is_callable([$obj->getId(), '__toString']) ? (string) $obj->getId() : $obj->getId()), (null === $obj->getVersion() || is_scalar($obj->getVersion()) || is_callable([$obj->getVersion(), '__toString']) ? (string) $obj->getVersion() : $obj->getVersion())]);
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
     * @param mixed $value A \Ncanode\Model\SignatureVersion object or a primary key value.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \Ncanode\Model\SignatureVersion) {
                $key = serialize([(null === $value->getId() || is_scalar($value->getId()) || is_callable([$value->getId(), '__toString']) ? (string) $value->getId() : $value->getId()), (null === $value->getVersion() || is_scalar($value->getVersion()) || is_callable([$value->getVersion(), '__toString']) ? (string) $value->getVersion() : $value->getVersion())]);

            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key";
                $key = serialize([(null === $value[0] || is_scalar($value[0]) || is_callable([$value[0], '__toString']) ? (string) $value[0] : $value[0]), (null === $value[1] || is_scalar($value[1]) || is_callable([$value[1], '__toString']) ? (string) $value[1] : $value[1])]);
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \Ncanode\Model\SignatureVersion object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 6 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return serialize([(null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]), (null === $row[TableMap::TYPE_NUM == $indexType ? 6 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 6 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 6 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 6 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 6 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)])]);
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
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 6 + $offset
                : self::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SignatureVersionTableMap::CLASS_DEFAULT : SignatureVersionTableMap::OM_CLASS;
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
     * @return array           (SignatureVersion object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = SignatureVersionTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SignatureVersionTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SignatureVersionTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SignatureVersionTableMap::OM_CLASS;
            /** @var SignatureVersion $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SignatureVersionTableMap::addInstanceToPool($obj, $key);
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
            $key = SignatureVersionTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SignatureVersionTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SignatureVersion $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SignatureVersionTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SignatureVersionTableMap::COL_ID);
            $criteria->addSelectColumn(SignatureVersionTableMap::COL_DOCUMENT);
            $criteria->addSelectColumn(SignatureVersionTableMap::COL_THREAD);
            $criteria->addSelectColumn(SignatureVersionTableMap::COL_CMS);
            $criteria->addSelectColumn(SignatureVersionTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SignatureVersionTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(SignatureVersionTableMap::COL_VERSION);
            $criteria->addSelectColumn(SignatureVersionTableMap::COL_VERSION_CREATED_AT);
            $criteria->addSelectColumn(SignatureVersionTableMap::COL_VERSION_CREATED_BY);
            $criteria->addSelectColumn(SignatureVersionTableMap::COL_VERSION_COMMENT);
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
            $criteria->removeSelectColumn(SignatureVersionTableMap::COL_ID);
            $criteria->removeSelectColumn(SignatureVersionTableMap::COL_DOCUMENT);
            $criteria->removeSelectColumn(SignatureVersionTableMap::COL_THREAD);
            $criteria->removeSelectColumn(SignatureVersionTableMap::COL_CMS);
            $criteria->removeSelectColumn(SignatureVersionTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SignatureVersionTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(SignatureVersionTableMap::COL_VERSION);
            $criteria->removeSelectColumn(SignatureVersionTableMap::COL_VERSION_CREATED_AT);
            $criteria->removeSelectColumn(SignatureVersionTableMap::COL_VERSION_CREATED_BY);
            $criteria->removeSelectColumn(SignatureVersionTableMap::COL_VERSION_COMMENT);
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
        return Propel::getServiceContainer()->getDatabaseMap(SignatureVersionTableMap::DATABASE_NAME)->getTable(SignatureVersionTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(SignatureVersionTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(SignatureVersionTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new SignatureVersionTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a SignatureVersion or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or SignatureVersion object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SignatureVersionTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Ncanode\Model\SignatureVersion) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SignatureVersionTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = array($values);
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(SignatureVersionTableMap::COL_ID, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(SignatureVersionTableMap::COL_VERSION, $value[1]));
                $criteria->addOr($criterion);
            }
        }

        $query = SignatureVersionQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SignatureVersionTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SignatureVersionTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the ncanode_signature_version table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return SignatureVersionQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SignatureVersion or Criteria object.
     *
     * @param mixed               $criteria Criteria or SignatureVersion object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SignatureVersionTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SignatureVersion object
        }


        // Set the correct dbName
        $query = SignatureVersionQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // SignatureVersionTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
SignatureVersionTableMap::buildTableMap();
