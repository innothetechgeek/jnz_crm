<!DOCTYPE html>
<html>
<title>New Agent SignUp</title>
<body>
<style>
	body{background:#f2f3f5;
        font: 15px sans-serif;
    }
    .button{
    font-size: 16px;
    color: #ffffff;
    text-decoration: none;
    border-radius: 2px;
    background-color: #28A745;
    border-top: 12px solid #28A745;
    border-bottom: 12px solid #28A745;
    border-right: 18px solid #28A745;
    border-left: 18px solid #28A745;
    display: inline-block;
    
    }
</style>
<table border="0" cellpadding="0" style = "" cellspacing="0" height="100%" width="100%" id="bodyTable">
    <tr>
        <td align="center" valign="top">
            <table border="0" style = "background:#fff;margin-top:25px" cellpadding="" cellspacing="0" width="580" id="emailContainer">
                <tr>
                    <td  valign="top">
                        <table border="0" cellpadding="20" cellspacing="0" width="100%" id="emailHeader" >
                            <tr >
                                <td style = "border-top: 4px solid #51647c; border-bottom:2px solid #51647c;"  valign="top" >
                                    <!-- <img width = "150" alt="" src="https://vanguard-wealth.com/upload/orig/logo_49391.png">  -->
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="top">
                        <table border="0" cellpadding="20" cellspacing="0" width="100%" id="emailBody">
                            <tr>
                                <td  valign="top">
                                    Hi <span>Admin, a new agent has signed up. Below are thier details:</span>
                                   
                                    <p>Personal Details.</p>
                                        <ul style = "list-style-type:none;padding:0px;line-height:1.5">
                                            <li>
                                                Name: <span  style = "color: #51647c"><strong><?= $data['agent_name'] ?></strong></span>
                                            </li>
                                            <li>
                                                Surname: <span  style = "color: #51647c"><strong><?= $data['agent_landline'] ?></strong></span>
                                            </li>
                                            <li>
                                                Id Number: <span  style = "color: #51647c"><strong><?= $data['agent_idnumber'] ?></strong></span>
                                            </li>
                                            <li>
                                                Cell Nr: <span  style = "color: #51647c"><strong><?= $data['agent_cellphone_number'] ?></strong></span>
                                            </li>
                                            <li>
                                                Landline: <span  style = "color: #51647c"><strong><?= $data['agent_landline'] ?></strong></span>
                                            </li>

                                    </ul>
                                    <p>Address.</p>
                                        <ul style = "list-style-type:none;padding:0px;line-height:1.5">
                                            <li>
                                                Address Line1: <span  style = "color: #51647c"><strong><?= $data['add_line1'] ?></strong></span>
                                            </li>
                                            <li>
                                                Address Line 2: <span  style = "color: #51647c"><strong><?= $data['add_line2'] ?></strong></span>
                                            </li>
                                            <li>
                                               City/Town: <span  style = "color: #51647c"><strong><?= $data['add_city'] ?></strong></span>
                                            </li>
                                            <li>
                                               Postal Code: <span  style = "color: #51647c"><strong><?= $data['add_postal_code'] ?></strong></span>
                                            </li>
                                    </ul>
                                    <p>Next Of Kin.</p>
                                        <ul style = "list-style-type:none;padding:0px;line-height:1.5">
                                            <li>
                                             Name: <span  style = "color: #51647c"><strong><?= $data['nok_name'] ?></strong></span>
                                            </li>
                                            <li>
                                             Surname: <span  style = "color: #51647c"><strong><?= $data['nok_surname'] ?></strong></span>
                                            </li>
                                            <li>
                                             Cell Number: <span  style = "color: #51647c"><strong><?= $data['nok_cell_number'] ?></strong></span>
                                        </li>
                                    </ul>
                                    <p>Question Unswers.</p>
                                        <ul style = "list-style-type:none;padding:0px;line-height:1.5">
                                            <?php foreach($data['questions'] as $key => $questionObj) { ?>
                                            <li>
                                                <?= $questionObj->question ?>: <span  style = "color: #51647c"><strong><?= $data['question_anwsers'][$questionObj->question_id] ?></strong></span>
                                            </li>
                                           <?php } ?>
                                        </ul>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                
            </table>
            <tr>
                    <td align="center" valign="top">
                        <table border="0" cellpadding="20" cellspacing="0" width="100%" id="emailFooter">
                            <tr>
                                <td valign="top">
                                    <p style = "font-size: 11px;
    color: #686f7a;" >Delivered by Vanguard 600 Harrison Street, 3rd Floor, Cape Town,  7600.</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
        </td>
    </tr>
</table
</body>
</html>