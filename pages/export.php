<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>export Exel</title>
</head>

<body>

    <?php
    require_once("connexiondb.php");
    
    $sql = "select * from employer";
    $fullname = isset($_GET['fullname']) ? $_GET['fullname'] : "";
   
        $requeteEmp="select e.idEmp,e.fullname,e.gender,e.dateN,e.cne,e.mobile,e.adresse,e.dateEmbauche,e.photo,d.nomDepartment
                from department as d,employer as e
                where d.idDepartment=e.idDepartment
                and fullname like '%$fullname%'
                order by idEmp
                ";
    $resultatEmp=$pdo->query($requeteEmp);
    $html = '<table>
<tr>
<th> Id Employee</th>
<th> Nom </th>
<th> Gender</th>
<th> Date Naissance</th>
<th> CIN </th>
<th> Telephone </th>
<th> Adresse</th>
<th> Date Embauche</th>
<th> Photo</th>
<th> Department</th>

</tr>';

while ($employer=$resultatEmp->fetch()) {
    $html.='<tr> 
   
                                    <td>
                                        '. $employer['idEmp'] .'
                                    </td>
                                    <td>
                                        '. $employer['fullname'] .'
                                    </td>
                                    <td>
                                        '.$employer['gender'] .'
                                    </td>
                                    <td>
                                        '.$employer['dateN'] .'
                                    </td>
                                    <td>
                                        '.$employer['cne'].'
                                    </td>
                                    <td>
                                        '.$employer['mobile'].'
                                    </td>
                                    <td>
                                    '.$employer['adresse'].'
                                    </td>
                                    <td>
                                    '.$employer['dateEmbauche'].'
                                    </td>
                                    <td>
                                    <img src="http://localhost/exemple (1)\StageProject\images'.$employer['photo'] .'"
                                    style="width:50px;height:50px;">
                                </td>
                                    <td>
                                         '.$employer['nomDepartment'] .'
                                    </td>
                                
                            </tr>';
}
   
$html.='</table>';

header("Content-Type: application/xls");
header("Content-Disposition: attachement; Filename= EmployerData.xls");
echo $html;


?>

    </table>
</body>

</html>