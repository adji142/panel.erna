<!doctype html>
<?php
//buka koneksi ke engine MySQL
    $Open = mysqli_connect("localhost","root","lagis3nt0s4","ernashop");
    //mysqli_connect("localhost","root","hsp123","dealsys");
        // $Open = mysqli_connect("localhost","root","lagis3nt0s4","dealsys");
        if (!$Open){
            die ("Koneksi ke Engine MySQL Gagal !<br>");
        }
    $id = $_GET['id'];
?>

<html>
<head>
    <meta charset="utf-8">
    <title>A simple, clean, and responsive HTML invoice template</title>
    
    <style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <!-- <img src="https://www.sparksuite.com/images/logo.png" style="width:100%; max-width:300px;"> -->
                            </td>
                            <td>
                                <?php
                                    $sql = "SELECT a.*,b.name prov,c.name kota,d.name kec,e.name kel FROM deliveryorder a
                                            LEFT JOIN provinces b on a.provinsi = b.id
                                            LEFT JOIN regencies c on a.kota = c.id
                                            LEFT JOIN districts d on a.kecamatan = d.id
                                            LEFT JOIN villages e on e.id = a.kelurahan where a.id =".$id."";
                                    $result = mysqli_query($Open,$sql) or die(mysql_error());
                                    $row = mysqli_fetch_assoc($result);

                                    echo "Invoice #: ".$row['nomerorder']."<br>";
                                    echo "Created: ".$row['tglorder']."<br>";
                                ?>
                                <!-- Due: February 1, 2015 -->
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                <a href="#">nama.com</a><br>
                                Alamat1<br>
                                Notlp
                            </td>
                            <td>
                                <?php
                                    echo "".$row['penerima'].".<br>";
                                    echo "".substr($row['alamatkirim'], 0,15)."<br>";
                                    echo "".substr($row['alamatkirim'], 16,255)."<br>";
                                    echo "".$row['kota'].", KEL ".$row['kel']."<br>";
                                    echo "KEC ".$row['kec'].", PROV ".$row['prov']."<br>";
                                    echo "Kode POS".$row['kodepos']."<br>";
                                    echo "Nomer Tlp".$row['tlp']."<br>";
                                ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="heading">
                <td>
                    Item
                </td>
                <td>
                    Price
                </td>
            </tr>
            <?php
                $id = $row['id'];
                $rs = mysqli_query($Open, "SELECT 
                    c.tittle,SUM(b.qtyorder) qtyorder,SUM(b.gros) gros,c.price
                FROM deliveryorder a
                LEFT JOIN deliveryorderdetail b on a.id = b.headerid
                LEFT JOIN post_product c on c.id = b.postid
                WHERE a.id = $id
                GROUP BY c.tittle");
                while ($rsx = mysqli_fetch_array($rs)) {
                    $Item = stripslashes ($rsx['tittle']);
                    $qtyorder = stripslashes ($rsx['qtyorder']);
                    $price = stripslashes ($rsx['price']);
                    $gros = stripslashes ($rsx['gros']);
                    echo "
                        <tr>
                          <td>".$Item." (".$qtyorder." x ".number_format($price).")</td>
                          <td>".number_format($gros)."</td>
                        </tr>
                      ";
                }

                // line total

                $totalline = mysqli_query($Open,"
                    SELECT 'Sub Total' title,SUM(gros) total FROM deliveryorderdetail WHERE headerid = $id
                    UNION
                    SELECT 'Discount' title,SUM(discount) total FROM deliveryorderdetail WHERE headerid = $id
                    UNION
                    SELECT 'Ongkir' title,SUM(ongkir) total FROM deliveryorderdetail WHERE headerid = $id
                    UNION
                    SELECT 'TOTAL' title,SUM(gros - discount + ongkir) total FROM deliveryorderdetail WHERE headerid = $id
                    ");
                while ($rsxy = mysqli_fetch_array($totalline)) {
                    $title = stripslashes ($rsxy['title']);
                    $total = stripslashes ($rsxy['total']);
                    echo "
                        <tr class = 'total'>
                          <td align = 'right'>".$title."</td>
                          <td>".number_format($total)."</td>
                        </tr>
                      ";
                }
            ?>
        </table>
    </div>
</body>
</html>