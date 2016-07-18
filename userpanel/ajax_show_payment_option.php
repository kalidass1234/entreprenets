<table align="center" class="pmpro_checkout top1em" id="pmpro_levels_table" style="display: table;
        border-collapse: separate;
        border-spacing: 2px;
        border-color: gray; width:100%;">
            <thead style="display: table-header-group;
            vertical-align: middle;
            border-color: inherit;">
                <tr>
                  <th class="show_vision_level">Level</th>
                  <th class="show_vision_level">Initial Payment</th>
                  <th class="show_vision_level">Subscription Pricing</th>
                  <th class="show_vision_level">Trial Period/Duration</th>
                  <th class="show_vision_level">Select Payment</th>
                </tr>
            </thead>
            <tbody>
            <?php
            //echo "<pre>"; print_r($_SESSION); 
            $category=$_GET['category'];
            if($category==2)
            {
            ?>
               <tr class="odd">
                    <td align="center">Vision Team Network Monthly <br><br>Membership</td>
                    <td align="center">$29.99</td>
                    <td align="center"><strong>$84.98</strong>per<br><br> Month</td>		
                    <td align="center"><strong>12 payments</strong> total.<br><br>Membership expires after 1 year.</td>
                    <td align="center"><input type="radio" name="other_duration" checked="checked" value="1" onclick="showpaymenttotal(this.value,2);" /></td>
                </tr>
                <tr class="even">
                    <td align="center">Vision Team Network Membership - 3<br><br> month option</td>
                    <td align="center">$29.99</td>
                    <td align="center"><strong>$254.94</strong>every 3 <br><br>Months</td>		
                    <td align="center"><strong>12 payments</strong> total.<br><br>
                    Membership expires after 1 year.</td>
                    <td align="center"><input type="radio" name="other_duration" value="3" onclick="showpaymenttotal(this.value,2);" /></td>
                </tr>
                <tr class="odd">
                    <td align="center">Vision Team Network Membership - 6 <br><br>month option</td>
                    <td align="center">$29.99</td>
                    <td align="center"><strong>$509.88</strong>every 6<br><br> Months</td>		
                    <td align="center"><strong>12 payments</strong> total.<br><br>Membership expires after 1 year.</td>
                    <td align="center"><input type="radio" name="other_duration" value="6" onclick="showpaymenttotal(this.value,2);" /></td>
                </tr>
                <tr class="even">
                    <td align="center">Vision Team Network Membership - 12 <br><br>month option</td>
                    <td align="center">$29.99</td>
                    <td align="center"><strong>$1,019.76</strong>every 12 <br><br>Months</td>		
                    <td align="center"><strong>12 payments</strong> total.<br><br>Membership expires after 1 year.</td>
                    <td align="center"><input type="radio" name="other_duration" value="12" onclick="showpaymenttotal(this.value,2);" /></td>
                </tr>
             <?php
             }
             else if($category==3)
             {
             ?>
             <tr class="odd">
                    <td align="center"><nobr>Vision Team Network Monthly<br><br> Membership</nobr></td>
                    <td align="center">$150.00</td>
                    <td align="center"><strong>$150.00</strong>every 12 <br><br>Months</td>		
                    <td align="center"><strong>12 payments</strong> total.<br><br>Membership expires after 1 year.</td>
                    <td align="center"><a href="set_amt_duration_new.php?amount=150.00&duration=12&category=3" class="link-select">Select</a></td>
                </tr>
             <?php
             }
             else if($category==1)
             {
             ?>
                <tr class="odd">
                    <td align="center">Vision Team Network Monthly <br><br>Membership</td>
                    <td align="center">$29.99</td>
                    <td align="center"><strong>$29.99</strong>per<br><br> Month</td>		
                    <td align="center"><strong>12 payments</strong> total.<br><br>Membership expires after 1 year.</td>
                    <td align="center"><input type="radio" name="other_duration" checked="checked" value="1" onclick="showpaymenttotal(this.value,1);" /></td>
                </tr>
                <tr class="even">
                    <td align="center">Vision Team Network Membership - 3 <br><br>month option</td>
                    <td align="center">$89.97</td>
                    <td align="center"><strong>$89.97</strong>every 3<br><br> Months</td>		
                    <td align="center"><strong>12 payments</strong> total.<br><br>Membership expires after 1 year.</td>
                    <td align="center"><input type="radio" name="other_duration" value="3" onclick="showpaymenttotal(this.value,1);" /></td>
                </tr>
                <tr class="odd">
                    <td align="center">Vision Team Network Membership - 6<br><br> month option</td>
                    <td align="center">$179.94</td>
                    <td align="center"><strong>$179.94</strong>every 6<br><br> Months</td>		
                    <td align="center"><strong>12 payments</strong> total.<br><br>Membership expires after 1 year.</td>
                    <td align="center"><input type="radio" name="other_duration" value="6" onclick="showpaymenttotal(this.value,1);" /></td>
                </tr>
                <tr class="even">
                    <td align="center">Vision Team Network Membership - 12 <br><br>month option</td>
                    <td align="center">$359.88</td>
                    <td align="center"><strong>$359.88</strong>every 12 <br><br>Months</td>		
                    <td align="center"><strong>12 payments</strong> total.<br><br>Membership expires after 1 year.</td>
                    <td align="center"><input type="radio" name="other_duration" value="12" onclick="showpaymenttotal(this.value,1);" /></td>
                </tr>
             <?php
             }
             ?>   
            </tbody>
        </table>