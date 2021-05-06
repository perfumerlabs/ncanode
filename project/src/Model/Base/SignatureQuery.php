<?php

namespace Ncanode\Model\Base;

use \Exception;
use \PDO;
use Ncanode\Model\Signature as ChildSignature;
use Ncanode\Model\SignatureQuery as ChildSignatureQuery;
use Ncanode\Model\Map\SignatureTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'ncanode_signature' table.
 *
 *
 *
 * @method     ChildSignatureQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildSignatureQuery orderByDocument($order = Criteria::ASC) Order by the document column
 * @method     ChildSignatureQuery orderByThread($order = Criteria::ASC) Order by the thread column
 * @method     ChildSignatureQuery orderByCms($order = Criteria::ASC) Order by the cms column
 * @method     ChildSignatureQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSignatureQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildSignatureQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildSignatureQuery orderByVersionCreatedAt($order = Criteria::ASC) Order by the version_created_at column
 * @method     ChildSignatureQuery orderByVersionCreatedBy($order = Criteria::ASC) Order by the version_created_by column
 * @method     ChildSignatureQuery orderByVersionComment($order = Criteria::ASC) Order by the version_comment column
 *
 * @method     ChildSignatureQuery groupById() Group by the id column
 * @method     ChildSignatureQuery groupByDocument() Group by the document column
 * @method     ChildSignatureQuery groupByThread() Group by the thread column
 * @method     ChildSignatureQuery groupByCms() Group by the cms column
 * @method     ChildSignatureQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSignatureQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildSignatureQuery groupByVersion() Group by the version column
 * @method     ChildSignatureQuery groupByVersionCreatedAt() Group by the version_created_at column
 * @method     ChildSignatureQuery groupByVersionCreatedBy() Group by the version_created_by column
 * @method     ChildSignatureQuery groupByVersionComment() Group by the version_comment column
 *
 * @method     ChildSignatureQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSignatureQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSignatureQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSignatureQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSignatureQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSignatureQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSignatureQuery leftJoinSignatureTag($relationAlias = null) Adds a LEFT JOIN clause to the query using the SignatureTag relation
 * @method     ChildSignatureQuery rightJoinSignatureTag($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SignatureTag relation
 * @method     ChildSignatureQuery innerJoinSignatureTag($relationAlias = null) Adds a INNER JOIN clause to the query using the SignatureTag relation
 *
 * @method     ChildSignatureQuery joinWithSignatureTag($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SignatureTag relation
 *
 * @method     ChildSignatureQuery leftJoinWithSignatureTag() Adds a LEFT JOIN clause and with to the query using the SignatureTag relation
 * @method     ChildSignatureQuery rightJoinWithSignatureTag() Adds a RIGHT JOIN clause and with to the query using the SignatureTag relation
 * @method     ChildSignatureQuery innerJoinWithSignatureTag() Adds a INNER JOIN clause and with to the query using the SignatureTag relation
 *
 * @method     ChildSignatureQuery leftJoinSignatureVersion($relationAlias = null) Adds a LEFT JOIN clause to the query using the SignatureVersion relation
 * @method     ChildSignatureQuery rightJoinSignatureVersion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SignatureVersion relation
 * @method     ChildSignatureQuery innerJoinSignatureVersion($relationAlias = null) Adds a INNER JOIN clause to the query using the SignatureVersion relation
 *
 * @method     ChildSignatureQuery joinWithSignatureVersion($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SignatureVersion relation
 *
 * @method     ChildSignatureQuery leftJoinWithSignatureVersion() Adds a LEFT JOIN clause and with to the query using the SignatureVersion relation
 * @method     ChildSignatureQuery rightJoinWithSignatureVersion() Adds a RIGHT JOIN clause and with to the query using the SignatureVersion relation
 * @method     ChildSignatureQuery innerJoinWithSignatureVersion() Adds a INNER JOIN clause and with to the query using the SignatureVersion relation
 *
 * @method     \Ncanode\Model\SignatureTagQuery|\Ncanode\Model\SignatureVersionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSignature|null findOne(ConnectionInterface $con = null) Return the first ChildSignature matching the query
 * @method     ChildSignature findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSignature matching the query, or a new ChildSignature object populated from the query conditions when no match is found
 *
 * @method     ChildSignature|null findOneById(int $id) Return the first ChildSignature filtered by the id column
 * @method     ChildSignature|null findOneByDocument(string $document) Return the first ChildSignature filtered by the document column
 * @method     ChildSignature|null findOneByThread(string $thread) Return the first ChildSignature filtered by the thread column
 * @method     ChildSignature|null findOneByCms(string $cms) Return the first ChildSignature filtered by the cms column
 * @method     ChildSignature|null findOneByCreatedAt(string $created_at) Return the first ChildSignature filtered by the created_at column
 * @method     ChildSignature|null findOneByUpdatedAt(string $updated_at) Return the first ChildSignature filtered by the updated_at column
 * @method     ChildSignature|null findOneByVersion(int $version) Return the first ChildSignature filtered by the version column
 * @method     ChildSignature|null findOneByVersionCreatedAt(string $version_created_at) Return the first ChildSignature filtered by the version_created_at column
 * @method     ChildSignature|null findOneByVersionCreatedBy(string $version_created_by) Return the first ChildSignature filtered by the version_created_by column
 * @method     ChildSignature|null findOneByVersionComment(string $version_comment) Return the first ChildSignature filtered by the version_comment column *

 * @method     ChildSignature requirePk($key, ConnectionInterface $con = null) Return the ChildSignature by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSignature requireOne(ConnectionInterface $con = null) Return the first ChildSignature matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSignature requireOneById(int $id) Return the first ChildSignature filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSignature requireOneByDocument(string $document) Return the first ChildSignature filtered by the document column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSignature requireOneByThread(string $thread) Return the first ChildSignature filtered by the thread column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSignature requireOneByCms(string $cms) Return the first ChildSignature filtered by the cms column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSignature requireOneByCreatedAt(string $created_at) Return the first ChildSignature filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSignature requireOneByUpdatedAt(string $updated_at) Return the first ChildSignature filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSignature requireOneByVersion(int $version) Return the first ChildSignature filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSignature requireOneByVersionCreatedAt(string $version_created_at) Return the first ChildSignature filtered by the version_created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSignature requireOneByVersionCreatedBy(string $version_created_by) Return the first ChildSignature filtered by the version_created_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSignature requireOneByVersionComment(string $version_comment) Return the first ChildSignature filtered by the version_comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSignature[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSignature objects based on current ModelCriteria
 * @method     ChildSignature[]|ObjectCollection findById(int $id) Return ChildSignature objects filtered by the id column
 * @method     ChildSignature[]|ObjectCollection findByDocument(string $document) Return ChildSignature objects filtered by the document column
 * @method     ChildSignature[]|ObjectCollection findByThread(string $thread) Return ChildSignature objects filtered by the thread column
 * @method     ChildSignature[]|ObjectCollection findByCms(string $cms) Return ChildSignature objects filtered by the cms column
 * @method     ChildSignature[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildSignature objects filtered by the created_at column
 * @method     ChildSignature[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildSignature objects filtered by the updated_at column
 * @method     ChildSignature[]|ObjectCollection findByVersion(int $version) Return ChildSignature objects filtered by the version column
 * @method     ChildSignature[]|ObjectCollection findByVersionCreatedAt(string $version_created_at) Return ChildSignature objects filtered by the version_created_at column
 * @method     ChildSignature[]|ObjectCollection findByVersionCreatedBy(string $version_created_by) Return ChildSignature objects filtered by the version_created_by column
 * @method     ChildSignature[]|ObjectCollection findByVersionComment(string $version_comment) Return ChildSignature objects filtered by the version_comment column
 * @method     ChildSignature[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SignatureQuery extends ModelCriteria
{

    // versionable behavior

    /**
     * Whether the versioning is enabled
     */
    static $isVersioningEnabled = true;
protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Ncanode\Model\Base\SignatureQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'ncanode', $modelName = '\\Ncanode\\Model\\Signature', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSignatureQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSignatureQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSignatureQuery) {
            return $criteria;
        }
        $query = new ChildSignatureQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildSignature|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SignatureTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SignatureTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSignature A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, document, thread, cms, created_at, updated_at, version, version_created_at, version_created_by, version_comment FROM ncanode_signature WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildSignature $obj */
            $obj = new ChildSignature();
            $obj->hydrate($row);
            SignatureTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildSignature|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildSignatureQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SignatureTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSignatureQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SignatureTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSignatureQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(SignatureTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(SignatureTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SignatureTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the document column
     *
     * Example usage:
     * <code>
     * $query->filterByDocument('fooValue');   // WHERE document = 'fooValue'
     * $query->filterByDocument('%fooValue%', Criteria::LIKE); // WHERE document LIKE '%fooValue%'
     * </code>
     *
     * @param     string $document The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSignatureQuery The current query, for fluid interface
     */
    public function filterByDocument($document = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($document)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SignatureTableMap::COL_DOCUMENT, $document, $comparison);
    }

    /**
     * Filter the query on the thread column
     *
     * Example usage:
     * <code>
     * $query->filterByThread('fooValue');   // WHERE thread = 'fooValue'
     * $query->filterByThread('%fooValue%', Criteria::LIKE); // WHERE thread LIKE '%fooValue%'
     * </code>
     *
     * @param     string $thread The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSignatureQuery The current query, for fluid interface
     */
    public function filterByThread($thread = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($thread)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SignatureTableMap::COL_THREAD, $thread, $comparison);
    }

    /**
     * Filter the query on the cms column
     *
     * Example usage:
     * <code>
     * $query->filterByCms('fooValue');   // WHERE cms = 'fooValue'
     * $query->filterByCms('%fooValue%', Criteria::LIKE); // WHERE cms LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cms The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSignatureQuery The current query, for fluid interface
     */
    public function filterByCms($cms = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cms)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SignatureTableMap::COL_CMS, $cms, $comparison);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSignatureQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(SignatureTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(SignatureTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SignatureTableMap::COL_CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSignatureQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(SignatureTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(SignatureTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SignatureTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query on the version column
     *
     * Example usage:
     * <code>
     * $query->filterByVersion(1234); // WHERE version = 1234
     * $query->filterByVersion(array(12, 34)); // WHERE version IN (12, 34)
     * $query->filterByVersion(array('min' => 12)); // WHERE version > 12
     * </code>
     *
     * @param     mixed $version The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSignatureQuery The current query, for fluid interface
     */
    public function filterByVersion($version = null, $comparison = null)
    {
        if (is_array($version)) {
            $useMinMax = false;
            if (isset($version['min'])) {
                $this->addUsingAlias(SignatureTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(SignatureTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SignatureTableMap::COL_VERSION, $version, $comparison);
    }

    /**
     * Filter the query on the version_created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByVersionCreatedAt('2011-03-14'); // WHERE version_created_at = '2011-03-14'
     * $query->filterByVersionCreatedAt('now'); // WHERE version_created_at = '2011-03-14'
     * $query->filterByVersionCreatedAt(array('max' => 'yesterday')); // WHERE version_created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $versionCreatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSignatureQuery The current query, for fluid interface
     */
    public function filterByVersionCreatedAt($versionCreatedAt = null, $comparison = null)
    {
        if (is_array($versionCreatedAt)) {
            $useMinMax = false;
            if (isset($versionCreatedAt['min'])) {
                $this->addUsingAlias(SignatureTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedAt['max'])) {
                $this->addUsingAlias(SignatureTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SignatureTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt, $comparison);
    }

    /**
     * Filter the query on the version_created_by column
     *
     * Example usage:
     * <code>
     * $query->filterByVersionCreatedBy('fooValue');   // WHERE version_created_by = 'fooValue'
     * $query->filterByVersionCreatedBy('%fooValue%', Criteria::LIKE); // WHERE version_created_by LIKE '%fooValue%'
     * </code>
     *
     * @param     string $versionCreatedBy The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSignatureQuery The current query, for fluid interface
     */
    public function filterByVersionCreatedBy($versionCreatedBy = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($versionCreatedBy)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SignatureTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy, $comparison);
    }

    /**
     * Filter the query on the version_comment column
     *
     * Example usage:
     * <code>
     * $query->filterByVersionComment('fooValue');   // WHERE version_comment = 'fooValue'
     * $query->filterByVersionComment('%fooValue%', Criteria::LIKE); // WHERE version_comment LIKE '%fooValue%'
     * </code>
     *
     * @param     string $versionComment The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSignatureQuery The current query, for fluid interface
     */
    public function filterByVersionComment($versionComment = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($versionComment)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SignatureTableMap::COL_VERSION_COMMENT, $versionComment, $comparison);
    }

    /**
     * Filter the query by a related \Ncanode\Model\SignatureTag object
     *
     * @param \Ncanode\Model\SignatureTag|ObjectCollection $signatureTag the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSignatureQuery The current query, for fluid interface
     */
    public function filterBySignatureTag($signatureTag, $comparison = null)
    {
        if ($signatureTag instanceof \Ncanode\Model\SignatureTag) {
            return $this
                ->addUsingAlias(SignatureTableMap::COL_ID, $signatureTag->getSignatureId(), $comparison);
        } elseif ($signatureTag instanceof ObjectCollection) {
            return $this
                ->useSignatureTagQuery()
                ->filterByPrimaryKeys($signatureTag->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySignatureTag() only accepts arguments of type \Ncanode\Model\SignatureTag or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SignatureTag relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSignatureQuery The current query, for fluid interface
     */
    public function joinSignatureTag($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SignatureTag');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SignatureTag');
        }

        return $this;
    }

    /**
     * Use the SignatureTag relation SignatureTag object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Ncanode\Model\SignatureTagQuery A secondary query class using the current class as primary query
     */
    public function useSignatureTagQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSignatureTag($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SignatureTag', '\Ncanode\Model\SignatureTagQuery');
    }

    /**
     * Filter the query by a related \Ncanode\Model\SignatureVersion object
     *
     * @param \Ncanode\Model\SignatureVersion|ObjectCollection $signatureVersion the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSignatureQuery The current query, for fluid interface
     */
    public function filterBySignatureVersion($signatureVersion, $comparison = null)
    {
        if ($signatureVersion instanceof \Ncanode\Model\SignatureVersion) {
            return $this
                ->addUsingAlias(SignatureTableMap::COL_ID, $signatureVersion->getId(), $comparison);
        } elseif ($signatureVersion instanceof ObjectCollection) {
            return $this
                ->useSignatureVersionQuery()
                ->filterByPrimaryKeys($signatureVersion->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySignatureVersion() only accepts arguments of type \Ncanode\Model\SignatureVersion or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SignatureVersion relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSignatureQuery The current query, for fluid interface
     */
    public function joinSignatureVersion($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SignatureVersion');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SignatureVersion');
        }

        return $this;
    }

    /**
     * Use the SignatureVersion relation SignatureVersion object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Ncanode\Model\SignatureVersionQuery A secondary query class using the current class as primary query
     */
    public function useSignatureVersionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSignatureVersion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SignatureVersion', '\Ncanode\Model\SignatureVersionQuery');
    }

    /**
     * Filter the query by a related Tag object
     * using the ncanode_signature_tag table as cross reference
     *
     * @param Tag $tag the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSignatureQuery The current query, for fluid interface
     */
    public function filterByTag($tag, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useSignatureTagQuery()
            ->filterByTag($tag, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   ChildSignature $signature Object to remove from the list of results
     *
     * @return $this|ChildSignatureQuery The current query, for fluid interface
     */
    public function prune($signature = null)
    {
        if ($signature) {
            $this->addUsingAlias(SignatureTableMap::COL_ID, $signature->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the ncanode_signature table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SignatureTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SignatureTableMap::clearInstancePool();
            SignatureTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SignatureTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SignatureTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SignatureTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SignatureTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildSignatureQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(SignatureTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildSignatureQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(SignatureTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildSignatureQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(SignatureTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildSignatureQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(SignatureTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildSignatureQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(SignatureTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildSignatureQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(SignatureTableMap::COL_CREATED_AT);
    }

    // versionable behavior

    /**
     * Checks whether versioning is enabled
     *
     * @return boolean
     */
    static public function isVersioningEnabled()
    {
        return self::$isVersioningEnabled;
    }

    /**
     * Enables versioning
     */
    static public function enableVersioning()
    {
        self::$isVersioningEnabled = true;
    }

    /**
     * Disables versioning
     */
    static public function disableVersioning()
    {
        self::$isVersioningEnabled = false;
    }

} // SignatureQuery
