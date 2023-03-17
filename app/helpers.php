<?php
/**
 * Created by PhpStorm.
 * User: hbot
 * Date: 5/1/17
 * Time: 11:37 AM
 */

function hasUserPermission($user_id,$permission_id){

        $havePermission = \DB::table('user_has_permissions')->where('user_id',$user_id)->where('permission_id',$permission_id)->get();
        if(count($havePermission)){
            return true;
        }
        return false;
}
function getUserRole($user){
    if($user->hasRole('admin')) { return  'Admin'; }
    if($user->hasRole('supervisor')) { return  'Supervisor'; }
    if($user->hasRole('operator')) { return  'Operator'; }

}

function floorLevel($floor){
    $floors = [
        '0' => 'Ground',
        '-1' => 'Basement',
        '1' => '1st',
        '2' => '2nd',
        '3' => '3rd',
        '4' => '4th',
        '5' => '5th',
        '6' => '6th',
        '7' => '7th',
        '8' => '8th',
        '9' => '9th',
        '10' => '10th',
        '11' => '11th',
        '12' => '12th',
        '13' => '13th',
        '14' => '14th',
        '15' => '15th',
        '16' => '16th',
        '17' => '17th',
        '18' => '18th',
        '19' => '19th',
        '20' => '20th',
        '21' => '21th',
        '22' => '22th',
        '23' => '23th',
        '24' => '24th',
        '25' => '25th',
        '26' => '26th',
        '27' => '27th',
        '28' => '28th',
        '29' => '29th',
        '30' => '30th'
    ];
    return $floors[$floor];
}
function flatType($type){
    $types = [
          '1' => '1-Bedroom',
          '2' => '2-Bedroom',
          '3' => '3-Bedroom',
          '4' => '4-Bedroom',
          '5' => '5-Bedroom',
          '6' => '6-Bedroom',
          '7' => 'Single-Shop',
          '8' => 'Double-Shop',
          '9' => 'WareHouse',
          '10' => 'Store',
          '11' => 'Space',
          '12' => 'Show Room'
    ];
    return $types[$type];
}