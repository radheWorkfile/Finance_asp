<?php
defined('BASEPATH') OR exit('Can we play bubu together ?');

    # Advance Setting Details
    $config['mlm_registration_free'] = "0";    #Is registration is free ?
    $config['mlm_e-pin'] = "0";                            #Want to enable e-PIN ?
    $config['mlm_registration'] = "0";              #Stop New Member Registration ?
    $config['mlm_topup_option'] = "0";              #Want to enable Top-Up Options ?
    $config['mlm_topup_income'] = "0";              #Want to Give Income when Top-Up ?
    $config['mlm_leg_option'] = "0";                  #Want to show Leg Select Option at Sign Up form ?
    $config['mlm_joining_product'] = "0";        #Want to show Joining Products at Registration form ?
    $config['mlm_placement_id_option'] = "0"; #Want to show Placement ID Option at Sign Up form ?
    $config['mlm_fix_income'] = "0";                  #Give Fix Income (Not Product/Service Based Income) ?
    $config['mlm_product_delivered'] = "1";    #Automatically mark registration products as Delivered ?
    $config['mlm_leg'] = "2";                                #Automatically mark registration products as Delivered ?
    
    #Enable/Disable Module
    $config['mlm_survey_module'] = "1";                    #Enable Survey ?
    $config['mlm_coupon_module'] = "1";                    #Enable Coupon ?
    $config['mlm_investment_module'] = "0";            #Investment Type ?
    $config['mlm_investment_plan_module'] = "0";  #Investment Plan ?
    $config['mlm_rewards_module'] = "0";                  #Enable Investment Plan ?
    $config['mlm_recharge_module'] = "1";                #Enable Rewards Module?
    $config['mlm_product_module'] = "1";                  #Enable Recharge Module ?
    $config['mlm_repurchase_module'] = "1";            #Enable Product & Services ?
    $config['mlm_advertisment_module'] = "1";        #Enable Repurchase System ?
?>