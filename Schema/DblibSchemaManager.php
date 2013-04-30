<?php

namespace DABSquared\MssqlBundle\Schema;

use Doctrine\DBAL\Schema\SQLServerSchemaManager;

/**
 * Schema manager for the MsSql/Dblib RDBMS.
 *
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @author      Scott Morken <scott.morken@pcmail.maricopa.edu>
 * @author      Konsta Vesterinen <kvesteri@cc.hut.fi>
 * @author      Lukas Smith <smith@pooteeweet.org> (PEAR MDB2 library)
 * @author      Roman Borschel <roman@code-factory.org>
 * @author      Benjamin Eberlei <kontakt@beberlei.de>
 * @version     $Revision$
 * @since       2.0
 */

class DblibSchemaManager extends SQLServerSchemaManager
{
    protected function _getPortableSequenceDefinition($sequence)
    {
        return end($sequence);
    }



    public function createDatabase($name)
    {
        $query = "CREATE DATABASE $name";
        if ($this->_conn->options['database_device']) {
            $query.= ' ON '.$this->_conn->options['database_device'];
            $query.= $this->_conn->options['database_size'] ? '=' .
                $this->_conn->options['database_size'] : '';
        }
        return $this->_conn->standaloneQuery($query, null, true);
    }

    /**
     * {@inheritdoc}
     */
    public function createSequence($seqName, $start = 1, $allocationSize = 1)
    {
        $seqcolName = 'seq_col';
        $query = 'CREATE TABLE ' . $seqName . ' (' . $seqcolName .
            ' INT PRIMARY KEY CLUSTERED IDENTITY(' . $start . ', 1) NOT NULL)';

        $res = $this->_conn->exec($query);

        if ($start == 1) {
            return true;
        }

        try {
            $query = 'SET IDENTITY_INSERT ' . $seqName . ' ON ' .
                'INSERT INTO ' . $seqName . ' (' . $seqName . ') VALUES ( ' . $start . ')';
            $res = $this->_conn->exec($query);
        } catch (Exception $e) {
            $result = $this->_conn->exec('DROP TABLE ' . $seqName);
        }
        return true;
    }




}
