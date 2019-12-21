<h1>Billing Information</h1>
<table cellspacing="3" cellpadding="3"  width="100%" class="table">
     <tr>
            <td>First Name</td>
            <td><input type="text" name="first_name" id="first_name" value="<?=$_REQUEST['first_name']?>" class="form-control" required/></td>
      </tr>
      <tr>
            <td>Last Name</td>
            <td><input type="text" name="last_name" id="last_name"  value="<?=$_REQUEST['last_name']?>" class="form-control" required/></td>
     </tr>
     <tr>
        <td><span>Country: *</span>
        </td>
        <td>
              <select id="country"  name="country"  class="form-control">
                <option value="">Select Country</option>
                <option value="ZW" <?php if($_REQUEST['country']=="ZW"){ echo "selected";}?>>Zimbabwe</option>
                <option value="ZM" <?php if($_REQUEST['country']=="ZM"){ echo "selected";}?>>Zambia</option>
                <option value="YE" <?php if($_REQUEST['country']=="YE"){ echo "selected";}?>>Yemen</option>
                <option value="EH" <?php if($_REQUEST['country']=="EH"){ echo "selected";}?>>Western Sahara</option>
                <option value="WF"   <?php if($_REQUEST['country']=="WF"){ echo "selected";}?>>Wallis and Futuna</option>				
                <option value="VI"   <?php if($_REQUEST['country']=="VI"){ echo "selected";}?>>Virgin Islands, US</option>
                <option value="VG"   <?php if($_REQUEST['country']=="VG"){ echo "selected";}?>>Virgin Islands, British</option>
                <option value="VN"   <?php if($_REQUEST['country']=="VN"){ echo "selected";}?>>Vietnam</option>
                <option value="VE"   <?php if($_REQUEST['country']=="VE"){ echo "selected";}?>>Venezuela</option>
                <option value="VA"   <?php if($_REQUEST['country']=="VA"){ echo "selected";}?>>Vatican City</option>
                <option value="VU"   <?php if($_REQUEST['country']=="VU"){ echo "selected";}?>>Vanuatu</option>
                <option value="UZ"   <?php if($_REQUEST['country']=="UZ"){ echo "selected";}?>>Uzbekistan</option>
                <option value="UY"   <?php if($_REQUEST['country']=="UY"){ echo "selected";}?>>Uruguay</option>
                <option value="UM"   <?php if($_REQUEST['country']=="UM"){ echo "selected";}?>>United States Minor Outlying Islands</option>
                <option value="US"   <?php if($_REQUEST['country']=="US"){ echo "selected";}?>>United States</option>
                <option value="GB"   <?php if($_REQUEST['country']=="GB"){ echo "selected";}?>>United Kingdom</option>
                <option value="AE"   <?php if($_REQUEST['country']=="AE"){ echo "selected";}?>>United Arab Emirates</option>
                <option value="UA"   <?php if($_REQUEST['country']=="UA"){ echo "selected";}?>>Ukraine</option>
                <option value="UG"   <?php if($_REQUEST['country']=="UG"){ echo "selected";}?>>Uganda</option>
                <option value="TV"   <?php if($_REQUEST['country']=="TV"){ echo "selected";}?>>Tuvalu</option>
                <option value="TC"   <?php if($_REQUEST['country']=="TC"){ echo "selected";}?>>Turks and Caicos Islands</option>
                <option value="TM"   <?php if($_REQUEST['country']=="TM"){ echo "selected";}?>>Turkmenistan</option>
                <option value="TR"   <?php if($_REQUEST['country']=="TR"){ echo "selected";}?>>Turkey</option>
                <option value="TN"   <?php if($_REQUEST['country']=="TN"){ echo "selected";}?>>Tunisia</option>
                <option value="TT"   <?php if($_REQUEST['country']=="TT"){ echo "selected";}?>>Trinidad and Tobago</option>
                <option value="TO"   <?php if($_REQUEST['country']=="TO"){ echo "selected";}?>>Tonga</option>
                <option value="TK"   <?php if($_REQUEST['country']=="TK"){ echo "selected";}?>>Tokelau</option>
                <option value="TG"   <?php if($_REQUEST['country']=="TG"){ echo "selected";}?>>Togo</option>
                <option value="TL"   <?php if($_REQUEST['country']=="TL"){ echo "selected";}?>>Timor-Leste (East Timor)</option>
                <option value="TH"   <?php if($_REQUEST['country']=="TH"){ echo "selected";}?>>Thailand</option>
                <option value="TZ"   <?php if($_REQUEST['country']=="TZ"){ echo "selected";}?>>Tanzania</option>
                <option value="TJ"   <?php if($_REQUEST['country']=="TJ"){ echo "selected";}?>>Tajikistan</option>
                <option value="TW"   <?php if($_REQUEST['country']=="TW"){ echo "selected";}?>>Taiwan</option>
                <option value="SY"   <?php if($_REQUEST['country']=="SY"){ echo "selected";}?>>Syria</option>
                <option value="CH"   <?php if($_REQUEST['country']=="CH"){ echo "selected";}?>>Switzerland</option>				
                <option value="SE"   <?php if($_REQUEST['country']=="SE"){ echo "selected";}?>>Sweden</option>
                <option value="SZ"   <?php if($_REQUEST['country']=="SZ"){ echo "selected";}?>>Swaziland</option>
                <option value="SJ"   <?php if($_REQUEST['country']=="SJ"){ echo "selected";}?>>Svalbard and Jan Mayen</option>
                <option value="SR"   <?php if($_REQUEST['country']=="SR"){ echo "selected";}?>>Suriname</option>				
                <option value="SD"   <?php if($_REQUEST['country']=="SD"){ echo "selected";}?>>Sudan</option>
                <option value="LK"   <?php if($_REQUEST['country']=="LK"){ echo "selected";}?>>Sri Lanka</option>
                <option value="ES"   <?php if($_REQUEST['country']=="ES"){ echo "selected";}?>>Spain</option>
                <option value="SS"   <?php if($_REQUEST['country']=="SS"){ echo "selected";}?>>South Sudan</option>
                <option value="KR"   <?php if($_REQUEST['country']=="KR"){ echo "selected";}?>>South Korea</option>				
                <option value="GS"   <?php if($_REQUEST['country']=="GS"){ echo "selected";}?>>South Georgia and the South Sandwich Islands</option>
                <option value="ZA"   <?php if($_REQUEST['country']=="ZA"){ echo "selected";}?>>South Africa</option>
                <option value="SO"   <?php if($_REQUEST['country']=="SO"){ echo "selected";}?>>Somalia</option>
                <option value="SB"   <?php if($_REQUEST['country']=="SB"){ echo "selected";}?>>Solomon Islands</option>
                <option value="SI"   <?php if($_REQUEST['country']=="SI"){ echo "selected";}?>>Slovenia</option>				
                <option value="SK"   <?php if($_REQUEST['country']=="SK"){ echo "selected";}?>>Slovakia</option>
                <option value="SX"   <?php if($_REQUEST['country']=="SX"){ echo "selected";}?>>Sint Maarten</option>
                <option value="SG"   <?php if($_REQUEST['country']=="SG"){ echo "selected";}?>>Singapore</option>
                <option value="SL"   <?php if($_REQUEST['country']=="SL"){ echo "selected";}?>>Sierra Leone</option>
                <option value="SC"   <?php if($_REQUEST['country']=="SC"){ echo "selected";}?>>Seychelles</option>
                <option value="RS"   <?php if($_REQUEST['country']=="RS"){ echo "selected";}?>>Serbia</option>				
                <option value="SN"   <?php if($_REQUEST['country']=="SN"){ echo "selected";}?>>Senegal</option>
                <option value="SA"   <?php if($_REQUEST['country']=="SA"){ echo "selected";}?>>Saudi Arabia</option>
                <option value="ST"   <?php if($_REQUEST['country']=="ST"){ echo "selected";}?>>Sao Tome and Principe</option>
                <option value="SM"   <?php if($_REQUEST['country']=="SM"){ echo "selected";}?>>San Marino</option>
                <option value="WS"   <?php if($_REQUEST['country']=="WS"){ echo "selected";}?>>Samoa</option>				
                <option value="VC"   <?php if($_REQUEST['country']=="VC"){ echo "selected";}?>>Saint Vincent and the Grenadines</option>
                <option value="PM"   <?php if($_REQUEST['country']=="PM"){ echo "selected";}?>>Saint Pierre and Miquelon</option>
                <option value="MF"   <?php if($_REQUEST['country']=="MF"){ echo "selected";}?>>Saint Martin</option>
                <option value="LC"   <?php if($_REQUEST['country']=="LC"){ echo "selected";}?>>Saint Lucia</option>
                <option value="KN"   <?php if($_REQUEST['country']=="KN"){ echo "selected";}?>>Saint Kitts and Nevis</option>				
                <option value="SH"   <?php if($_REQUEST['country']=="SH"){ echo "selected";}?>>Saint Helena</option>
                <option value="BL"   <?php if($_REQUEST['country']=="BL"){ echo "selected";}?>>Saint Barthelemy</option>
                <option value="RW"   <?php if($_REQUEST['country']=="RW"){ echo "selected";}?>>Rwanda</option>
                <option value="RU"   <?php if($_REQUEST['country']=="RU"){ echo "selected";}?>>Russia</option>
                <option value="RO"   <?php if($_REQUEST['country']=="RO"){ echo "selected";}?>>Romania</option>				
                <option value="RE"   <?php if($_REQUEST['country']=="RE"){ echo "selected";}?>>Reunion</option>
                <option value="QA"   <?php if($_REQUEST['country']=="QA"){ echo "selected";}?>>Qatar</option>
                <option value="PR"   <?php if($_REQUEST['country']=="PR"){ echo "selected";}?>>Puerto Rico</option>
                <option value="PT"   <?php if($_REQUEST['country']=="PT"){ echo "selected";}?>>Portugal</option>
                <option value="PL"   <?php if($_REQUEST['country']=="PL"){ echo "selected";}?>>Poland</option>				
                <option value="PN"   <?php if($_REQUEST['country']=="PN"){ echo "selected";}?>>Pitcairn</option>
                <option value="PH"   <?php if($_REQUEST['country']=="PH"){ echo "selected";}?>>Phillipines</option>
                <option value="PE"   <?php if($_REQUEST['country']=="PE"){ echo "selected";}?>>Peru</option>
                <option value="PY"   <?php if($_REQUEST['country']=="PY"){ echo "selected";}?>>Paraguay</option>
                <option value="PG"   <?php if($_REQUEST['country']=="PG"){ echo "selected";}?>>Papua New Guinea</option>
                <option value="PA"   <?php if($_REQUEST['country']=="PA"){ echo "selected";}?>>Panama</option>				
                <option value="PS"   <?php if($_REQUEST['country']=="PS"){ echo "selected";}?>>Palestine</option>
                <option value="PW"   <?php if($_REQUEST['country']=="PW"){ echo "selected";}?>>Palau</option>
                <option value="PK"   <?php if($_REQUEST['country']=="PK"){ echo "selected";}?>>Pakistan</option>
                <option value="OM"   <?php if($_REQUEST['country']=="OM"){ echo "selected";}?>>Oman</option>
                <option value="NO"   <?php if($_REQUEST['country']=="NO"){ echo "selected";}?>>Norway</option>
                <option value="MP"   <?php if($_REQUEST['country']=="MP"){ echo "selected";}?>>Northern Mariana Islands</option>
                <option value="KP"   <?php if($_REQUEST['country']=="KP"){ echo "selected";}?>>North Korea</option>				
                <option value="NF"   <?php if($_REQUEST['country']=="NF"){ echo "selected";}?>>Norfolk Island</option>
                <option value="NU"   <?php if($_REQUEST['country']=="NU"){ echo "selected";}?>>Niue</option>
                <option value="NG"   <?php if($_REQUEST['country']=="NG"){ echo "selected";}?>>Nigeria</option>
                <option value="NE"   <?php if($_REQUEST['country']=="NE"){ echo "selected";}?>>Niger</option>
                <option value="NI"   <?php if($_REQUEST['country']=="NI"){ echo "selected";}?>>Nicaragua</option>				
                <option value="NZ"   <?php if($_REQUEST['country']=="NZ"){ echo "selected";}?>>New Zealand</option>
                <option value="NC"   <?php if($_REQUEST['country']=="NC"){ echo "selected";}?>>New Caledonia</option>
                <option value="NL"   <?php if($_REQUEST['country']=="NL"){ echo "selected";}?>>Netherlands</option>
                <option value="NP"   <?php if($_REQUEST['country']=="NP"){ echo "selected";}?>>Nepal</option>
                <option value="NR"   <?php if($_REQUEST['country']=="NR"){ echo "selected";}?>>Nauru</option>				
                <option value="NA"   <?php if($_REQUEST['country']=="NA"){ echo "selected";}?>>Namibia</option>
                <option value="MM"   <?php if($_REQUEST['country']=="MM"){ echo "selected";}?>>Myanmar (Burma)</option>
                <option value="MZ"   <?php if($_REQUEST['country']=="MZ"){ echo "selected";}?>>Mozambique</option>
                <option value="MA"   <?php if($_REQUEST['country']=="MA"){ echo "selected";}?>>Morocco</option>
                <option value="MS"   <?php if($_REQUEST['country']=="MS"){ echo "selected";}?>>Montserrat</option>
                <option value="ME"   <?php if($_REQUEST['country']=="ME"){ echo "selected";}?>>Montenegro</option>
                <option value="MN"   <?php if($_REQUEST['country']=="MN"){ echo "selected";}?>>Mongolia</option>				
                <option value="MC"   <?php if($_REQUEST['country']=="MC"){ echo "selected";}?>>Monaco</option>
                <option value="MD"   <?php if($_REQUEST['country']=="MD"){ echo "selected";}?>>Moldava</option>
                <option value="FM"   <?php if($_REQUEST['country']=="FM"){ echo "selected";}?>>Micronesia</option>
                <option value="MX"   <?php if($_REQUEST['country']=="MX"){ echo "selected";}?>>Mexico</option>
                <option value="YT"   <?php if($_REQUEST['country']=="YT"){ echo "selected";}?>>Mayotte</option>
                <option value="MU"   <?php if($_REQUEST['country']=="MU"){ echo "selected";}?>>Mauritius</option>				
                <option value="MR"   <?php if($_REQUEST['country']=="MR"){ echo "selected";}?>>Mauritania</option>
                <option value="MQ"   <?php if($_REQUEST['country']=="MQ"){ echo "selected";}?>>Martinique</option>
                <option value="MH"   <?php if($_REQUEST['country']=="MH"){ echo "selected";}?>>Marshall Islands</option>
                <option value="MT"   <?php if($_REQUEST['country']=="MT"){ echo "selected";}?>>Malta</option>
                <option value="ML"   <?php if($_REQUEST['country']=="ML"){ echo "selected";}?>>Mali</option>
                <option value="MV"   <?php if($_REQUEST['country']=="MV"){ echo "selected";}?>>Maldives</option>				
                <option value="MY"   <?php if($_REQUEST['country']=="MY"){ echo "selected";}?>>Malaysia</option>
                <option value="MW"   <?php if($_REQUEST['country']=="MW"){ echo "selected";}?>>Malawi</option>
                <option value="MG"   <?php if($_REQUEST['country']=="MG"){ echo "selected";}?>>Madagascar</option>
                <option value="MK"   <?php if($_REQUEST['country']=="MK"){ echo "selected";}?>>Macedonia</option>
                <option value="MO"   <?php if($_REQUEST['country']=="MO"){ echo "selected";}?>>Macao</option>				
                <option value="LU"   <?php if($_REQUEST['country']=="LU"){ echo "selected";}?>>Luxembourg</option>
                <option value="LT"   <?php if($_REQUEST['country']=="LT"){ echo "selected";}?>>Lithuania</option>
                <option value="LI"   <?php if($_REQUEST['country']=="LI"){ echo "selected";}?>>Liechtenstein</option>
                <option value="LY"   <?php if($_REQUEST['country']=="LY"){ echo "selected";}?>>Libya</option>
                <option value="LR"   <?php if($_REQUEST['country']=="LR"){ echo "selected";}?>>Liberia</option>				
                <option value="LS"   <?php if($_REQUEST['country']=="LS"){ echo "selected";}?>>Lesotho</option>
                <option value="LB"   <?php if($_REQUEST['country']=="LB"){ echo "selected";}?>>Lebanon</option>
                <option value="LV"   <?php if($_REQUEST['country']=="LV"){ echo "selected";}?>>Latvia</option>
                <option value="LA"   <?php if($_REQUEST['country']=="LA"){ echo "selected";}?>>Laos</option>				
                <option value="KG"   <?php if($_REQUEST['country']=="KG"){ echo "selected";}?>>Kyrgyzstan</option>
                <option value="KW"   <?php if($_REQUEST['country']=="KW"){ echo "selected";}?>>Kuwait</option>
                <option value="XK"   <?php if($_REQUEST['country']=="XK"){ echo "selected";}?>>Kosovo</option>
                <option value="KI"   <?php if($_REQUEST['country']=="KI"){ echo "selected";}?>>Kiribati</option>
                <option value="KE"   <?php if($_REQUEST['country']=="KE"){ echo "selected";}?>>Kenya</option>				
                <option value="KZ"   <?php if($_REQUEST['country']=="KZ"){ echo "selected";}?>>Kazakhstan</option>
                <option value="JO"   <?php if($_REQUEST['country']=="JO"){ echo "selected";}?>>Jordan</option>
                <option value="JE"   <?php if($_REQUEST['country']=="JE"){ echo "selected";}?>>Jersey</option>
                <option value="JP"   <?php if($_REQUEST['country']=="JP"){ echo "selected";}?>>Japan</option>
                <option value="JM"   <?php if($_REQUEST['country']=="JM"){ echo "selected";}?>>Jamaica</option>
                <option value="IT"   <?php if($_REQUEST['country']=="IT"){ echo "selected";}?>>Italy</option>				
                <option value="IL"   <?php if($_REQUEST['country']=="IL"){ echo "selected";}?>>Israel</option>
                <option value="IM"   <?php if($_REQUEST['country']=="IM"){ echo "selected";}?>>Isle of Man</option>
                <option value="IE"   <?php if($_REQUEST['country']=="IE"){ echo "selected";}?>>Ireland</option>
                <option value="IQ"   <?php if($_REQUEST['country']=="IQ"){ echo "selected";}?>>Iraq</option>
                <option value="IR"   <?php if($_REQUEST['country']=="IR"){ echo "selected";}?>>Iran</option>
                <option value="ID"   <?php if($_REQUEST['country']=="ID"){ echo "selected";}?>>Indonesia</option>
                <option value="IN"   <?php if($_REQUEST['country']=="IN"){ echo "selected";}?>>India</option>				
                <option value="IS"   <?php if($_REQUEST['country']=="IS"){ echo "selected";}?>>Iceland</option>
                <option value="HU"   <?php if($_REQUEST['country']=="HU"){ echo "selected";}?>>Hungary</option>
                <option value="HK"   <?php if($_REQUEST['country']=="HK"){ echo "selected";}?>>Hong Kong</option>
                <option value="HN"   <?php if($_REQUEST['country']=="HN"){ echo "selected";}?>>Honduras</option>
                <option value="HM"   <?php if($_REQUEST['country']=="HM"){ echo "selected";}?>>Heard Island and McDonald Islands</option>
                <option value="HT"   <?php if($_REQUEST['country']=="HT"){ echo "selected";}?>>Haiti</option>
                <option value="GY"   <?php if($_REQUEST['country']=="GY"){ echo "selected";}?>>Guyana</option>				
                <option value="GW"   <?php if($_REQUEST['country']=="GW"){ echo "selected";}?>>Guinea-Bissau</option>
                <option value="GN"   <?php if($_REQUEST['country']=="GN"){ echo "selected";}?>>Guinea</option>
                <option value="GG"   <?php if($_REQUEST['country']=="GG"){ echo "selected";}?>>Guernsey</option>
                <option value="GT"   <?php if($_REQUEST['country']=="GT"){ echo "selected";}?>>Guatemala</option>
                <option value="GU"   <?php if($_REQUEST['country']=="GU"){ echo "selected";}?>>Guam</option>
                <option value="GP"   <?php if($_REQUEST['country']=="GP"){ echo "selected";}?>>Guadaloupe</option>
                <option value="GD"   <?php if($_REQUEST['country']=="GD"){ echo "selected";}?>>Grenada</option>
                <option value="GL"   <?php if($_REQUEST['country']=="GL"){ echo "selected";}?>>Greenland</option>
                <option value="GR"   <?php if($_REQUEST['country']=="GR"){ echo "selected";}?>>Greece</option>
                <option value="GI"   <?php if($_REQUEST['country']=="GI"){ echo "selected";}?>>Gibraltar</option>				
                <option value="GH"   <?php if($_REQUEST['country']=="GH"){ echo "selected";}?>>Ghana</option>
                <option value="DE"   <?php if($_REQUEST['country']=="DE"){ echo "selected";}?>>Germany</option>
                <option value="GE"   <?php if($_REQUEST['country']=="GE"){ echo "selected";}?>>Georgia</option>
                <option value="GM"   <?php if($_REQUEST['country']=="GM"){ echo "selected";}?>>Gambia</option>
                <option value="GA"   <?php if($_REQUEST['country']=="GA"){ echo "selected";}?>>Gabon</option>				
                <option value="TF"   <?php if($_REQUEST['country']=="TF"){ echo "selected";}?>>French Southern Territories</option>
                <option value="PF"   <?php if($_REQUEST['country']=="PF"){ echo "selected";}?>>French Polynesia</option>
                <option value="GF"   <?php if($_REQUEST['country']=="GF"){ echo "selected";}?>>French Guiana</option>
                <option value="FR"   <?php if($_REQUEST['country']=="FR"){ echo "selected";}?>>France</option>
                <option value="FI"   <?php if($_REQUEST['country']=="FI"){ echo "selected";}?>>Finland</option>
                <option value="FJ"   <?php if($_REQUEST['country']=="FJ"){ echo "selected";}?>>Fiji</option>
                <option value="FO"   <?php if($_REQUEST['country']=="FO"){ echo "selected";}?>>Faroe Islands</option>				
                <option value="FK"   <?php if($_REQUEST['country']=="FK"){ echo "selected";}?>>Falkland Islands (Malvinas)</option>
                <option value="ET"   <?php if($_REQUEST['country']=="ET"){ echo "selected";}?>>Ethiopia</option>
                <option value="EE"   <?php if($_REQUEST['country']=="EE"){ echo "selected";}?>>Estonia</option>
                <option value="ER"   <?php if($_REQUEST['country']=="ER"){ echo "selected";}?>>Eritrea</option>
                <option value="GQ"   <?php if($_REQUEST['country']=="GQ"){ echo "selected";}?>>Equatorial Guinea</option>				
                <option value="SV"   <?php if($_REQUEST['country']=="SV"){ echo "selected";}?>>El Salvador</option>
                <option value="EG"   <?php if($_REQUEST['country']=="EG"){ echo "selected";}?>>Egypt</option>
                <option value="EC"   <?php if($_REQUEST['country']=="EC"){ echo "selected";}?>>Ecuador</option>
                <option value="DO"   <?php if($_REQUEST['country']=="DO"){ echo "selected";}?>>Dominican Republic</option>
                <option value="DM"   <?php if($_REQUEST['country']=="DM"){ echo "selected";}?>>Dominica</option>				
                <option value="DJ"   <?php if($_REQUEST['country']=="DJ"){ echo "selected";}?>>Djibouti</option>
                <option value="DK"   <?php if($_REQUEST['country']=="DK"){ echo "selected";}?>>Denmark</option>
                <option value="CD"   <?php if($_REQUEST['country']=="CD"){ echo "selected";}?>>Democratic Republic of the Congo</option>
                <option value="CZ"   <?php if($_REQUEST['country']=="CZ"){ echo "selected";}?>>Czech Republic</option>
                <option value="CY"   <?php if($_REQUEST['country']=="CY"){ echo "selected";}?>>Cyprus</option>				
                <option value="CW"   <?php if($_REQUEST['country']=="CW"){ echo "selected";}?>>Curacao</option>
                <option value="CU"   <?php if($_REQUEST['country']=="CU"){ echo "selected";}?>>Cuba</option>
                <option value="HR"   <?php if($_REQUEST['country']=="HR"){ echo "selected";}?>>Croatia</option>
                <option value="CI"   <?php if($_REQUEST['country']=="CI"){ echo "selected";}?>>Cote d'ivoire (Ivory Coast)</option>
                <option value="CR"   <?php if($_REQUEST['country']=="CR"){ echo "selected";}?>>Costa Rica</option>
                <option value="CK"   <?php if($_REQUEST['country']=="CK"){ echo "selected";}?>>Cook Islands</option>				
                <option value="CG"   <?php if($_REQUEST['country']=="CG"){ echo "selected";}?>>Congo</option>
                <option value="KM"   <?php if($_REQUEST['country']=="KM"){ echo "selected";}?>>Comoros</option>
                <option value="CO"   <?php if($_REQUEST['country']=="CO"){ echo "selected";}?>>Colombia</option>
                <option value="CC"   <?php if($_REQUEST['country']=="CC"){ echo "selected";}?>>Cocos (Keeling) Islands</option>
                <option value="CX"   <?php if($_REQUEST['country']=="CX"){ echo "selected";}?>>Christmas Island</option>				
                <option value="CN"   <?php if($_REQUEST['country']=="CN"){ echo "selected";}?>>China</option>
                <option value="CL"   <?php if($_REQUEST['country']=="CL"){ echo "selected";}?>>Chile</option>
                <option value="TD"   <?php if($_REQUEST['country']=="TD"){ echo "selected";}?>>Chad</option>
                <option value="CF"   <?php if($_REQUEST['country']=="CF"){ echo "selected";}?>>Central African Republic</option>
                <option value="KY"   <?php if($_REQUEST['country']=="KY"){ echo "selected";}?>>Cayman Islands</option>
                <option value="CV"   <?php if($_REQUEST['country']=="CV"){ echo "selected";}?>>Cape Verde</option>
                <option value="CA"   <?php if($_REQUEST['country']=="CA"){ echo "selected";}?>>Canada</option>
                <option value="CM"   <?php if($_REQUEST['country']=="CM"){ echo "selected";}?>>Cameroon</option>				
                <option value="KH"   <?php if($_REQUEST['country']=="KH"){ echo "selected";}?>>Cambodia</option>
                <option value="BI"   <?php if($_REQUEST['country']=="BI"){ echo "selected";}?>>Burundi</option>
                <option value="BF"   <?php if($_REQUEST['country']=="BF"){ echo "selected";}?>>Burkina Faso</option>
                <option value="BG"   <?php if($_REQUEST['country']=="BG"){ echo "selected";}?>>Bulgaria</option>
                <option value="BN"   <?php if($_REQUEST['country']=="BN"){ echo "selected";}?>>Brunei</option>
                <option value="IO"   <?php if($_REQUEST['country']=="IO"){ echo "selected";}?>>British Indian Ocean Territory</option>
                <option value="BR"   <?php if($_REQUEST['country']=="BR"){ echo "selected";}?>>Brazil</option>				
                <option value="BV"   <?php if($_REQUEST['country']=="BV"){ echo "selected";}?>>Bouvet Island</option>
                <option value="BW"   <?php if($_REQUEST['country']=="BW"){ echo "selected";}?>>Botswana</option>
                <option value="BA"   <?php if($_REQUEST['country']=="BA"){ echo "selected";}?>>Bosnia and Herzegovina</option>
                <option value="BQ"   <?php if($_REQUEST['country']=="BQ"){ echo "selected";}?>>Bonaire, Sint Eustatius and Saba</option>
                <option value="BO"   <?php if($_REQUEST['country']=="BO"){ echo "selected";}?>>Bolivia</option>
                <option value="BT"   <?php if($_REQUEST['country']=="BT"){ echo "selected";}?>>Bhutan</option>
                <option value="BM"   <?php if($_REQUEST['country']=="BM"){ echo "selected";}?>>Bermuda</option>				
                <option value="BJ"   <?php if($_REQUEST['country']=="BJ"){ echo "selected";}?>>Benin</option>
                <option value="BZ"   <?php if($_REQUEST['country']=="BZ"){ echo "selected";}?>>Belize</option>
                <option value="BE"   <?php if($_REQUEST['country']=="BE"){ echo "selected";}?>>Belgium</option>
                <option value="BY"   <?php if($_REQUEST['country']=="BY"){ echo "selected";}?>>Belarus</option>
                <option value="BB"   <?php if($_REQUEST['country']=="BB"){ echo "selected";}?>>Barbados</option>
                <option value="BD"   <?php if($_REQUEST['country']=="BD"){ echo "selected";}?>>Bangladesh</option>
                <option value="BH"   <?php if($_REQUEST['country']=="BH"){ echo "selected";}?>>Bahrain</option>
                <option value="BS"   <?php if($_REQUEST['country']=="BS"){ echo "selected";}?>>Bahamas</option>
                <option value="AZ"   <?php if($_REQUEST['country']=="AZ"){ echo "selected";}?>>Azerbaijan</option>				
                <option value="AT"   <?php if($_REQUEST['country']=="AT"){ echo "selected";}?>>Austria</option>
                <option value="AU"   <?php if($_REQUEST['country']=="AU"){ echo "selected";}?>>Australia</option>
                <option value="AW"   <?php if($_REQUEST['country']=="AW"){ echo "selected";}?>>Aruba</option>
                <option value="AM"   <?php if($_REQUEST['country']=="AM"){ echo "selected";}?>>Armenia</option>
                <option value="AR"   <?php if($_REQUEST['country']=="AR"){ echo "selected";}?>>Argentina</option>				
                <option value="AG"   <?php if($_REQUEST['country']=="AG"){ echo "selected";}?>>Antigua and Barbuda</option>
                <option value="AQ"   <?php if($_REQUEST['country']=="AQ"){ echo "selected";}?>>Antarctica</option>
                <option value="AI"   <?php if($_REQUEST['country']=="AI"){ echo "selected";}?>>Anguilla</option>
                <option value="AO"   <?php if($_REQUEST['country']=="AO"){ echo "selected";}?>>Angola</option>
                <option value="AD"   <?php if($_REQUEST['country']=="AD"){ echo "selected";}?>>Andorra</option>				
                <option value="AS"   <?php if($_REQUEST['country']=="AS"){ echo "selected";}?>>American Samoa</option>
                <option value="DZ"   <?php if($_REQUEST['country']=="DZ"){ echo "selected";}?>>Algeria</option>
                <option value="AL"   <?php if($_REQUEST['country']=="AL"){ echo "selected";}?>>Albania</option>
                <option value="AX"   <?php if($_REQUEST['country']=="AX"){ echo "selected";}?>>Aland Islands</option>
                <option value="AF"   <?php if($_REQUEST['country']=="AF"){ echo "selected";}?>>Afghanistan</option>
             </select>
        </td>
     </tr>
     <tr>
        <td><span>Street Address: *</span>
        </td>
        <td>
            <input name="adress1" value="<?=$_REQUEST['adress1']?>" placeholder="Please enter your address" type="text"   tabindex="7"  class="form-control" required><br>
			<input name="adress2" value="<?=$_REQUEST['adress2']?>"  type="text" tabindex="8"  class="form-control">
        </td>
     </tr>
     <tr>
        <td><span>City: *</span>
        </td>
        <td><input name="city"  value="<?=$_REQUEST['city']?>"  type="text" placeholder="Please enter city name" tabindex="9"  class="form-control" required>
        </td>
     </tr>
     <tr>
        <td><span>State: *</span>
        </td>
        <td><input name="state"  value="<?=$_REQUEST['state']?>"  type="text"  placeholder="Please enter state" tabindex="10"  class="form-control">
        </td>
     </tr>
     <tr>
        <td><span>Postal Code: *</span>
        </td>
        <td><input name="zip_code"  value="<?=$_REQUEST['zip_code']?>"  type="text"   placeholder="Enter zip/postal code" tabindex="11"  class="form-control">
        </td>
     </tr>
     <tr>
        <td><span>Contact phone:</span>
        </td>
        <td><input name="contact_phone"  value="<?=$_REQUEST['contact_phone']?>"  type="text"   placeholder="Contact phone" tabindex="11"  class="form-control">
        </td>
     </tr>
</table>
         
<h1>Credit Card Information</h1>
<table cellspacing="3" cellpadding="3"  width="100%" class="table">
  <tr>
      <td><span>Card Type: *</span>
      </td>
      <td>
         <select name="card_type" id="card_type" tabindex="12"  class="form-control">
            <option value="">Please select a card type</option>
            <option value="American Express" <?php if( $_REQUEST['card_type'] == "American Express" ){ echo "selected";}?>>American Express</option>
            <option value="Discover"  <?php if( $_REQUEST['card_type'] == "Discover" ){ echo "selected";}?>>Discover</option>
            <option value="MasterCard"  <?php if( $_REQUEST['card_type'] == "MasterCard" ){ echo "selected";}?>>MasterCard</option>
            <option value="Visa"  <?php if( $_REQUEST['card_type'] == "Visa" ){ echo "selected";}?>>Visa</option>
         </select>
      </td>
  </tr>
  <tr>
      <td><span>Card Number: *</span>
      </td>
      <td>
          <input type="text" name="card_number"  value="<?=$_REQUEST['card_number']?>"  placeholder="Enter credit card number"  maxlength=16 tabindex="13"  class="form-control" required>
      </td>
  </tr>
  <tr>
      <td><span>Expiration Month/Year: *</span>
      </td>
      <td>
           <select class="short" id="expiration_month" name="expiration_month" tabindex="14"  required>
              <option value="01"  <?php if( $_REQUEST['expiration_month'] == "1" ){ echo "selected";}?>>01</option>
              <option value="02" <?php if( $_REQUEST['expiration_month'] == "2" ){ echo "selected";}?>>02</option>
              <option value="03" <?php if( $_REQUEST['expiration_month'] == "3" ){ echo "selected";}?>>03</option>
              <option value="04" <?php if( $_REQUEST['expiration_month'] == "4" ){ echo "selected";}?>>04</option>
              <option value="05" <?php if( $_REQUEST['expiration_month'] == "5" ){ echo "selected";}?>>05</option>
              <option value="06" <?php if( $_REQUEST['expiration_month'] == "6" ){ echo "selected";}?>>06</option>
              <option value="07" <?php if( $_REQUEST['expiration_month'] == "7" ){ echo "selected";}?>>07</option>
              <option value="08" <?php if( $_REQUEST['expiration_month'] == "8" ){ echo "selected";}?>>08</option>
              <option value="09" <?php if( $_REQUEST['expiration_month'] == "9" ){ echo "selected";}?>>09</option>
              <option value="10" <?php if( $_REQUEST['expiration_month'] == "10" ){ echo "selected";}?>>10</option>
              <option value="11" <?php if( $_REQUEST['expiration_month'] == "11" ){ echo "selected";}?>>11</option>
              <option value="12" <?php if( $_REQUEST['expiration_month'] == "12" ){ echo "selected";}?>>12</option>
            </select>

            <select class="short" id="expiration_year" name="expiration_year" tabindex="15"  required>
              <?php
			    $y = date("Y");
				for($i=0;$i<=25;$i++)
				{
				  $year = $y + $i;
			  ?>
              <option value="<?=$year?>"  <?php if( $_REQUEST['expiration_year'] == $year ){ echo "selected";}?>><?=$year?></option>
              <?php
			  }
			  ?>
            </select>
      </td>
  </tr>
  <tr>
      <td> <span>CVV: *</span>
      </td>
      <td><input name="verification_code"  value="<?=$_REQUEST['verification_code']?>"  type="text"  class="form-control" placeholder="Enter CVV" pattern="\d*" tabindex="16" required>
      </td>
  </tr>	
  <tr>
      <td> 
      </td>
      <td>
          <?php		   
			if (!empty($_SESSION['users_id']) ) 
			{
		  ?>
          <input type="hidden" name="payment_amuont" value="<?=number_format($total+$tax+$total_shipping_charge, 2, '.','')?>" />
          <input type="hidden" name="shipping_cost" value="<?=number_format($total_shipping_charge, 2, '.','')?>" />
          <input type="hidden" name="transaction_fee" value="<?=number_format($transaction_fee, 2, '.','')?>" />
          <input type="hidden" name="currency" value="<?=$_SESSION['cart'][0]['currency']?>" />
          <input type="hidden" name="cmd" value="order" />
          <input type="submit" value="Submit" class="btn btn-primary" />
          <?php
		   }
		  else
		   {
		  ?>
          <a href="<?=$site_url?>/member/login/">Please login first to submit your order</a>
          <?php
		   }
		  ?>
      </td>
  </tr>	
</table> 