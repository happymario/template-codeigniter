<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * MY_Model class
 */

class MY_Model extends CI_Model
{

    /* --------------------------------------------------------------
     * VARIABLES
     * ------------------------------------------------------------ */

    /**
     * 테이블명
     */
    protected $_table;

    /**
     * 프라이머리키
     */
    protected $primary_key;

    /**
     * 실제 어떤 식으로든 검색이 가능한 필드
     */
    public $allow_search_field = array();

    /**
     * 실제 어떤 식으로든 정렬이 가능한 필드
     */
    public $allow_order_field = array();

    /**
     * = 검색 필드, like 검색이 아님
     */
    public $search_field_equal = array();

    /* --------------------------------------------------------------
     * GENERIC METHODS
     * ------------------------------------------------------------ */
    /**
     * Initialise the model, tie into the CodeIgniter superobject and
     * try our best to guess the table name.
     */
    public function __construct()
    {
        parent::__construct();
    }


    public function get($primary_value = '', $select = '', $where = '', $limit = '', $offset = 0, $findex = '', $forder = '')
    {

        $result = $this->_get($primary_value, $select, $where, $limit, $offset, $findex, $forder);
        return $result->result_array();
    }


    public function get_one($primary_value = '', $select = '', $where = '')
    {
        $result = $this->_get($primary_value, $select, $where, 1);
        return $result->row_array();
    }


    public function _get($primary_value = '', $select = '', $where = '', $limit = '', $offset = 0, $findex = '', $forder = '')
    {
        if ($select) {
            $this->db->select($select);
        }
        $this->db->from($this->_table);
        if ($primary_value) {
            $this->db->where($this->primary_key, $primary_value);
        }
        if ($where) {
            $this->db->where($where);
        }
        if ($findex) {
            if (strtoupper($forder) === 'RANDOM') {
                $forder = 'RANDOM';
            } elseif (strtoupper($forder) === 'DESC') {
                $forder = 'DESC';
            } else {
                $forder = 'ASC';
            }
            $this->db->order_by($findex, $forder);
        }
        if (is_numeric($limit) && is_numeric($offset)) {
            $this->db->limit($limit, $offset);
        }
        $result = $this->db->get();

        return $result;
    }


    public function _get_list_common($select = '', $join = '', $limit = '', $offset = '', $where = '', $like = '', $findex = '', $forder = '', $sfield = '', $skeyword = '', $sop = 'OR')
    {
        if (empty($findex) OR ! in_array($findex, $this->allow_order_field)) {
            $findex = $this->primary_key;
        }

        $forder = (strtoupper($forder) === 'ASC') ? 'ASC' : 'DESC';
        $sop = (strtoupper($sop) === 'AND') ? 'AND' : 'OR';

        $count_by_where = array();
        $search_where = array();
        $search_like = array();
        $search_or_like = array();
        if ($sfield && is_array($sfield)) {
            foreach ($sfield as $skey => $sval) {
                $ssf = $sval;
                if ($skeyword && $ssf && in_array($ssf, $this->allow_search_field)) {
                    if (in_array($ssf, $this->search_field_equal)) {
                        $search_where[$ssf] = $skeyword;
                    } else {
                        $swordarray = explode(' ', $skeyword);
                        foreach ($swordarray as $str) {
                            if (empty($ssf)) {
                                continue;
                            }
                            if ($sop === 'AND') {
                                $search_like[] = array($ssf => $str);
                            } else {
                                $search_or_like[] = array($ssf => $str);
                            }
                        }
                    }
                }
            }
        } else {
            $ssf = $sfield;
            if ($skeyword && $ssf && in_array($ssf, $this->allow_search_field)) {
                if (in_array($ssf, $this->search_field_equal)) {
                    $search_where[$ssf] = $skeyword;
                } else {
                    $swordarray = explode(' ', $skeyword);
                    foreach ($swordarray as $str) {
                        if (empty($ssf)) {
                            continue;
                        }
                        if ($sop === 'AND') {
                            $search_like[] = array($ssf => $str);
                        } else {
                            $search_or_like[] = array($ssf => $str);
                        }
                    }
                }
            }
        }

        if ($select) {
            $this->db->select($select);
        }
        $this->db->from($this->_table);
        if ( ! empty($join['table']) && ! empty($join['on'])) {
            if (empty($join['type'])) {
                $join['type'] = 'left';
            }
            $this->db->join($join['table'], $join['on'], $join['type']);
        } elseif (is_array($join)) {
            foreach ($join as $jkey => $jval) {
                if ( ! empty($jval['table']) && ! empty($jval['on'])) {
                    if (empty($jval['type'])) {
                        $jval['type'] = 'left';
                    }
                    $this->db->join($jval['table'], $jval['on'], $jval['type']);
                }
            }
        }

        if ($where) {
            $this->db->where($where);
        }
        if ($search_where) {
            $this->db->where($search_where);
        }
        if ($like) {
            $this->db->like($like);
        }
        if ($search_like) {
            foreach ($search_like as $item) {
                foreach ($item as $skey => $sval) {
                    $this->db->like($skey, $sval);
                }
            }
        }
        if ($search_or_like) {
            $this->db->group_start();
            foreach ($search_or_like as $item) {
                foreach ($item as $skey => $sval) {
                    $this->db->or_like($skey, $sval);
                }
            }
            $this->db->group_end();
        }
        if ($count_by_where) {
            $this->db->where($count_by_where);
        }

        $this->db->order_by($findex, $forder);
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        $qry = $this->db->get();
        $result['list'] = $qry->result_array();

        $this->db->select('count(*) as rownum');
        $this->db->from($this->_table);
        if ( ! empty($join['table']) && ! empty($join['on'])) {
            if (empty($join['type'])) {
                $join['type'] = 'left';
            }
            $this->db->join($join['table'], $join['on'], $join['type']);
        } elseif (is_array($join)) {
            foreach ($join as $jkey => $jval) {
                if ( ! empty($jval['table']) && ! empty($jval['on'])) {
                    if (empty($jval['type'])) {
                        $jval['type'] = 'left';
                    }
                    $this->db->join($jval['table'], $jval['on'], $jval['type']);
                }
            }
        }
        if ($where) {
            $this->db->where($where);
        }
        if ($search_where) {
            $this->db->where($search_where);
        }
        if ($like) {
            $this->db->like($like);
        }
        if ($search_like) {
            foreach ($search_like as $item) {
                foreach ($item as $skey => $sval) {
                    $this->db->like($skey, $sval);
                }
            }
        }
        if ($search_or_like) {
            $this->db->group_start();
            foreach ($search_or_like as $item) {
                foreach ($item as $skey => $sval) {
                    $this->db->or_like($skey, $sval);
                }
            }
            $this->db->group_end();
        }
        if ($count_by_where) {
            $this->db->where($count_by_where);
        }
        $qry = $this->db->get();
        $rows = $qry->row_array();
        $result['total_rows'] = $rows['rownum'];

        return $result;
    }


    public function delete($primary_value = '', $where = '')
    {
        if ($primary_value) {
            $this->db->where($this->primary_key, $primary_value);
        }
        if ($where) {
            $this->db->where($where);
        }
        $result = $this->db->delete($this->_table);

        return $result;
    }


    public function delete_where($where = '')
    {
        if (empty($where)) {
            return;
        }

        $this->db->where($where);
        $result = $this->db->delete($this->_table);

        return $result;
    }


    public function update($primary_value = '', $updatedata = '', $where = '')
    {
        if ( ! empty($updatedata)) {
            if ( ! empty($primary_value)) {
                $this->db->where($this->primary_key, $primary_value);
            }
            if ( ! empty($where)) {
                $this->db->where($where);
            }
            $this->db->set($updatedata);
            $result = $this->db->update($this->_table);

            return $result;
        } else {
            return false;
        }
    }


    public function insert($data)
    {
        if ( ! empty($data)) {
            $this->db->insert($this->_table, $data);
            $insert_id = $this->db->insert_id();

            return $insert_id;
        } else {
            return 0;
        }
    }


    public function replace($data = '')
    {
        if ( ! empty($data)) {
            $this->db->replace($this->_table, $data);

            return true;
        } else {
            return false;
        }
    }


    public function count_by($where = '', $like = '')
    {
        if ($where) {
            $this->db->where($where);
        }
        if ($like) {
            $this->db->like($like);
        }
        return $this->db->count_all_results($this->_table);
    }


    public function update_plus($primary_value = '', $field = '', $count = '')
    {
        if (empty($primary_value) OR empty($field) OR empty($count)) {
            return false;
        }
        $this->db->where($this->primary_key, $primary_value);
        if ($count > 0) {
            $this->db->set($field, $field . '+' . $count, false);
        } else {
            $this->db->set($field, $field . $count, false);
        }
        $result = $this->db->update($this->_table);

        return $result;
    }

    public function save_by_uid($save_data, $uid = 0)
    {
        if ($uid > 0) {
            if (!$this->db->update($this->_table, $save_data, array('uid' => $uid))) {
                return FALSE;
            }
            return $uid;
        }
        if (!$this->db->insert($this->_table, $save_data)) {
            return FALSE;
        }
        return $this->db->insert_id();
    }

    public function get_result()
    {
        return $this->db->get($this->_table)->result();
    }

    public function get_result_by_status()
    {
        return $this->db->get_where($this->_table, array('status' => STATUS_NORMAL))->result();
    }

    public function get_cnt()
    {
        return $this->db->select('count(*) as cnt')->get($this->_table)->row('cnt');
    }

    public function get_ok_cnt()
    {
        return $this->db->select('count(*) as cnt')->get_where($this->_table, array('status' => STATUS_NORMAL))->row('cnt');
    }

    public function get_existing_cnt()
    {
        return $this->db->select('count(*) as cnt')->get_where($this->_table, array('status<>' => STATUS_DELETE))->row('cnt');
    }

    public function get_row()
    {
        return $this->db->get($this->_table)->row();
    }

    public function get_field_by_uid($uid, $field) {
        return $this->db->get_where($this->_table, array('uid' => $uid))->row($field);
    }

    public function get_row_by_uid($uid, $uid_field_nm = 'uid')
    {
        return $this->db->get_where($this->_table, array($uid_field_nm => $uid))->row();
    }

    public function get_row_array_by_uid($uid, $uid_field_nm = 'uid')
    {
        return $this->db->get_where($this->_table, array($uid_field_nm => $uid))->row_array();
    }

    public function delete_row_by_status($uid)
    {
        return $this->db->update($this->_table, array('status' => STATUS_DELETE), array('uid' => $uid));
    }

    public function delete_row($uid)
    {
        return $this->db->delete($this->_table, array('uid' => $uid));
    }
}
