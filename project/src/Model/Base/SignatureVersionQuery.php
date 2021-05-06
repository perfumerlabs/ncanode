<?php

namespace Ncanode\Model\Base;

use \Exception;
use \PDO;
use Ncanode\Model\SignatureVersion as ChildSignatureVersion;
use Ncanode\Model\SignatureVersionQuery as ChildSignatureVersionQuery;
use Ncanode\Model\Map\SignatureVersionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'ncanode_signature_version' table.
 *
 *
 *
 * @method     ChildSignatureVersionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildSignatureVersionQuery orderByDocument($order = Criteria::ASC) Order by the document column
 * @method     ChildSignatureVersionQuery orderByThread($order = Criteria::ASC) Order by the thread column
 * @method     ChildSignatureVersionQuery orderByCms($order = Criteria::ASC) Order by the cms column
 * @method     ChildSignatureVersionQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSignatureVersionQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildSignatureVersionQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildSignatureVersionQuery orderByVersionCreatedAt($order = Criteria::ASC) Order by the version_created_at column
 * @method     ChildSignatureVersionQuery orderByVersionCreatedBy($order = Criteria::ASC) Order by the version_created_by column
 * @method     ChildSignatureVersionQuery orderByVersionComment($order = Criteria::ASC) Order by the version_comment column
 *
 * @method     ChildSignatureVersionQuery groupById() Group by the id column
 * @method     ChildSignatureVersionQuery groupByDocument() Group by the document column
 * @method     ChildSignatureVersionQuery groupByThread() Group by the thread column
 * @method     ChildSignatureVersionQuery groupByCms() Group by the cms column
 * @method     ChildSignatureVersionQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSignatureVersionQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildSignatureVersionQuery groupByVersion() Group by the version column
 * @method     ChildSignatureVersionQuery groupByVersionCreatedAt() Group by the version_created_at column
 * @method     ChildSignatureVersionQuery groupByVersionCreatedBy() Group by the version_created_by column
 * @method     ChildSignatureVersionQuery groupByVersionComment() Group by the version_comment column
 *
 * @method     ChildSignatureVersionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSignatureVersionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSignatureVersionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSignatureVersionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSignatureVersionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSignatureVersionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSignatureVersionQuery leftJoinSignature($relationAlias = null) Adds a LEFT JOIN clause to the query using the Signature relation
 * @method     ChildSignatureVersionQuery rightJoinSignature($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Signature relation
 * @method     ChildSignatureVersionQuery innerJoinSignature($relationAlias = null) Adds a INNER JOIN clause to the query using the Signature relation
 *
 * @method     ChildSignatureVersionQuery joinWithSignature($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Signature relation
 *
 * @method     ChildSignatureVersionQuery leftJoinWithSignature() Adds a LEFT JOIN clause and with to the query using the Signature relation
 * @method     ChildSignatureVersionQuery rightJoinWithSignature() Adds a RIGHT JOIN clause and with to the query using the Signature relation
 * @method     ChildSignatureVersionQuery innerJoinWithSignature() Adds a INNER JOIN clause and with to the query using the Signature relation
 *
 * @method     \Ncanode\Model\SignatureQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSignatureVersion|null findOne(ConnectionInterface $con = null) Return the first ChildSignatureVersion matching the query
 * @method     ChildSignatureVersion findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSignatureVersion matching the query, or a new ChildSignatureVersion object populated from the query conditions when no match is found
 *
 * @method     ChildSignatureVersion|null findOneById(int $id) Return the first ChildSignatureVersion filtered by the id column
 * @method     ChildSignatureVersion|null findOneByDocument(string $document) Return the first ChildSignatureVersion filtered by the document column
 * @method     ChildSignatureVersion|null findOneByThread(string $thread) Return the first ChildSignatureVersion filtered by the thread column
 * @method     ChildSignatureVersion|null findOneByCms(string $cms) Return the first ChildSignatureVersion filtered by the cms column
 * @method     ChildSignatureVersion|null findOneByCreatedAt(string $created_at) Return the first ChildSignatureVersion filtered by the created_at column
 * @method     ChildSignatureVersion|null findOneByUpdatedAt(string $updated_at) Return the first ChildSignatureVersion filtered by the updated_at column
 * @method     ChildSignatureVersion|null findOneByVersion(int $version) Return the first ChildSignatureVersion filtered by the version column
 * @method     ChildSignatureVersion|null findOneByVersionCreatedAt(string $version_created_at) Return the first ChildSignatureVersion filtered by the version_created_at column
 * @method     ChildSignatureVersion|null findOneByVersionCreatedBy(string $version_created_by) Return the first ChildSignatureVersion filtered by the version_created_by column
 * @method     ChildSignatureVersion|null findOneByVersionComment(string $version_comment) Return the first ChildSignatureVersion filtered by the version_comment column *

 * @method     ChildSignatureVersion requirePk($key, ConnectionInterface $con = null) Return the ChildSignatureVersion by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSignatureVersion requireOne(ConnectionInterface $con = null) Return the first ChildSignatureVersion matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSignatureVersion requireOneById(int $id) Return the first ChildSignatureVersion filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSignatureVersion requireOneByDocument(string $document) Return the first ChildSignatureVersion filtered by the document column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSignatureVersion requireOneByThread(string $thread) Return the first ChildSignatureVersion filtered by the thread column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSignatureVersion requireOneByCms(string $cms) Return the first ChildSignatureVersion filtered by the cms column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSignatureVersion requireOneByCreatedAt(string $created_at) Return the first ChildSignatureVersion filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSignatureVersion requireOneByUpdatedAt(string $updated_at) Return the first ChildSignatureVersion filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSignatureVersion requireOneByVersion(int $version) Return the first ChildSignatureVersion filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSignatureVersion requireOneByVersionCreatedAt(string $version_created_at) Return the first ChildSignatureVersion filtered by the version_created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSignatureVersion requireOneByVersionCreatedBy(string $version_created_by) Return the first ChildSignatureVersion filtered by the version_created_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSignatureVersion requireOneByVersionComment(string $version_comment) Return the first ChildSignatureVersion filtered by the version_comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSignatureVersion[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSignatureVersion objects based on current ModelCriteria
 * @method     ChildSignatureVersion[]|ObjectCollection findById(int $id) Return ChildSignatureVersion objects filtered by the id column
 * @method     ChildSignatureVersion[]|ObjectCollection findByDocument(string $document) Return ChildSignatureVersion objects filtered by the document column
 * @method     ChildSignatureVersion[]|ObjectCollection findByThread(string $thread) Return ChildSignatureVersion objects filtered by the thread column
 * @method     ChildSignatureVersion[]|ObjectCollection findByCms(string $cms) Return ChildSignatureVersion objects filtered by the cms column
 * @method     ChildSignatureVersion[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildSignatureVersion objects filtered by the created_at column
 * @method     ChildSignatureVersion[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildSignatureVersion objects filtered by the updated_at column
 * @method     ChildSignatureVersion[]|ObjectCollection findByVersion(int $version) Return ChildSignatureVersion objects filtered by the version column
 * @method     ChildSignatureVersion[]|ObjectCollection findByVersionCreatedAt(string $version_created_at) Return ChildSignatureVersion objects filtered by the version_created_at column
 * @method     ChildSignatureVersion[]|ObjectCollection findByVersionCreatedBy(string $version_created_by) Return ChildSignatureVersion objects filtered by the version_created_by column
 * @method     ChildSignatureVersion[]|ObjectCollection findByVersionComment(string $version_comment) Return ChildSignatureVersion objects filtered by the version_comment column
 * @method     ChildSignatureVersion[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SignatureVersionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Ncanode\Model\Base\SignatureVersionQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'ncanode', $modelName = '\\Ncanode\\Model\\SignatureVersion', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSignatureVersionQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSignatureVersionQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSignatureVersionQuery) {
            return $criteria;
        }
        $query = new ChildSignatureVersionQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$id, $version] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildSignatureVersion|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SignatureVersionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SignatureVersionTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildSignatureVersion A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, document, thread, cms, created_at, updated_at, version, version_created_at, version_created_by, version_comment FROM ncanode_signature_version WHERE id = :p0 AND version = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildSignatureVersion $obj */
            $obj = new ChildSignatureVersion();
            $obj->hydrate($row);
            SignatureVersionTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildSignatureVersion|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
     * @return $this|ChildSignatureVersionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(SignatureVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(SignatureVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSignatureVersionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(SignatureVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(SignatureVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @see       filterBySignature()
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSignatureVersionQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(SignatureVersionTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(SignatureVersionTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SignatureVersionTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildSignatureVersionQuery The current query, for fluid interface
     */
    public function filterByDocument($document = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($document)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SignatureVersionTableMap::COL_DOCUMENT, $document, $comparison);
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
     * @return $this|ChildSignatureVersionQuery The current query, for fluid interface
     */
    public function filterByThread($thread = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($thread)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SignatureVersionTableMap::COL_THREAD, $thread, $comparison);
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
     * @return $this|ChildSignatureVersionQuery The current query, for fluid interface
     */
    public function filterByCms($cms = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cms)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SignatureVersionTableMap::COL_CMS, $cms, $comparison);
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
     * @return $this|ChildSignatureVersionQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(SignatureVersionTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(SignatureVersionTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SignatureVersionTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildSignatureVersionQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(SignatureVersionTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(SignatureVersionTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SignatureVersionTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
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
     * @return $this|ChildSignatureVersionQuery The current query, for fluid interface
     */
    public function filterByVersion($version = null, $comparison = null)
    {
        if (is_array($version)) {
            $useMinMax = false;
            if (isset($version['min'])) {
                $this->addUsingAlias(SignatureVersionTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(SignatureVersionTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SignatureVersionTableMap::COL_VERSION, $version, $comparison);
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
     * @return $this|ChildSignatureVersionQuery The current query, for fluid interface
     */
    public function filterByVersionCreatedAt($versionCreatedAt = null, $comparison = null)
    {
        if (is_array($versionCreatedAt)) {
            $useMinMax = false;
            if (isset($versionCreatedAt['min'])) {
                $this->addUsingAlias(SignatureVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedAt['max'])) {
                $this->addUsingAlias(SignatureVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SignatureVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt, $comparison);
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
     * @return $this|ChildSignatureVersionQuery The current query, for fluid interface
     */
    public function filterByVersionCreatedBy($versionCreatedBy = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($versionCreatedBy)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SignatureVersionTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy, $comparison);
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
     * @return $this|ChildSignatureVersionQuery The current query, for fluid interface
     */
    public function filterByVersionComment($versionComment = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($versionComment)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SignatureVersionTableMap::COL_VERSION_COMMENT, $versionComment, $comparison);
    }

    /**
     * Filter the query by a related \Ncanode\Model\Signature object
     *
     * @param \Ncanode\Model\Signature|ObjectCollection $signature The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSignatureVersionQuery The current query, for fluid interface
     */
    public function filterBySignature($signature, $comparison = null)
    {
        if ($signature instanceof \Ncanode\Model\Signature) {
            return $this
                ->addUsingAlias(SignatureVersionTableMap::COL_ID, $signature->getId(), $comparison);
        } elseif ($signature instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SignatureVersionTableMap::COL_ID, $signature->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterBySignature() only accepts arguments of type \Ncanode\Model\Signature or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Signature relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSignatureVersionQuery The current query, for fluid interface
     */
    public function joinSignature($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Signature');

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
            $this->addJoinObject($join, 'Signature');
        }

        return $this;
    }

    /**
     * Use the Signature relation Signature object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Ncanode\Model\SignatureQuery A secondary query class using the current class as primary query
     */
    public function useSignatureQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSignature($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Signature', '\Ncanode\Model\SignatureQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildSignatureVersion $signatureVersion Object to remove from the list of results
     *
     * @return $this|ChildSignatureVersionQuery The current query, for fluid interface
     */
    public function prune($signatureVersion = null)
    {
        if ($signatureVersion) {
            $this->addCond('pruneCond0', $this->getAliasedColName(SignatureVersionTableMap::COL_ID), $signatureVersion->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(SignatureVersionTableMap::COL_VERSION), $signatureVersion->getVersion(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the ncanode_signature_version table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SignatureVersionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SignatureVersionTableMap::clearInstancePool();
            SignatureVersionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SignatureVersionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SignatureVersionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SignatureVersionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SignatureVersionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // SignatureVersionQuery
