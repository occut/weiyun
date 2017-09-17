<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 16-11-17
 * Time: ����10:16
 */

namespace Admin\Model;

use Think\Model;
class ConfigListModel extends Model{
    /**
     * ����Ԫ����Ϣ
     */
    public function addConfigList($configList) {
        $result = M('configList')->add($configList);
        return $result;
    }
    /**
     *  ɾ��Ԫ�ر�configList��configList_idΪ$configListid��һ������
     */
    public function deleteConfigListById($configListid) {
        $result = M('configList')->delete($configListid);
        return $result;
    }

    /**
     *  �༭Ԫ�ر�configList��configList_idΪ$configListId��һ������
     */
    public function saveConfigList($configListId, $configList) {
        $result = M('configList')->where('list_id=' . $configListId)->save($configList);
        return $result;
    }
    /**
     * ����Ԫ�ر��е�����Ԫ��
     */
    public function selectAllConfigList() {
        $result = M('configList')->order('List_id')->select();
        return $result;
    }
    /**
     *  ����Ԫ�ر�configList��configList_idΪ$configListId��һ������
     */
    public function selectConfigListById($configListId) {
        $result = M('configList')->find($configListId);
        return $result;
    }

    /**
     * ��ȡԪ�ر��е�������
     */
    public function selectConfigListTotalSize() {
        $result = M('configList')->count();
        return $result;
    }
    /**
     * ��ҳ���ݼ�
     */
    public function selectConfigListByPage($Page) {
        $result = M('configList')->limit($Page->firstRow . ',' . $Page->listRows)->order('list_id desc')->select();
        return $result;
    }








}