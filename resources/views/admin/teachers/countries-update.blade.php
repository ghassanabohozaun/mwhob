<!--begin::Group-->
<div class="form-group row">
    <label class="col-xl-3 col-lg-3 col-form-label">
        {{trans('teachers.country')}}
    </label>
    <div class="col-lg-9 col-xl-9">


        <select class="form-control  form-control-lg"
                name="country" id="country">
            <option value="">{!! trans('teachers.select_county') !!}</option>

            <option value="Afghanistan"
                {!! $teacher->country == 'Afghanistan'?'selected':'' !!}>
                {!! trans('countries.Afghanistan') !!}
            </option>
            <option value="Albania"
                {!! $teacher->country == 'Albania'?'selected':'' !!}>
                {!! trans('countries.Albania') !!}
            </option>
            <option value="Algeria"
                {!! $teacher->country == 'Algeria'?'selected':'' !!}>
                {!! trans('countries.Algeria') !!}
            </option>
            <option value="American Samoa"
                {!! $teacher->country == 'American Samoa'?'selected':'' !!}>
                {!! trans('countries.American Samoa') !!}
            </option>
            <option value="Andorra"
                {!! $teacher->country == 'Andorra'?'selected':'' !!}>
                {!! trans('countries.Andorra') !!}
            </option>
            <option value="Angola"
                {!! $teacher->country == 'Angola'?'selected':'' !!}>
                {!! trans('countries.Angola') !!}
            </option>
            <option value="Anguilla"
                {!! $teacher->country == 'Anguilla'?'selected':'' !!}>
                {!! trans('countries.Anguilla') !!}
            </option>
            <option value="Antarctica"
                {!! $teacher->country == 'Antarctica'?'selected':'' !!}>
                {!! trans('countries.Antarctica') !!}
            </option>
            <option value="Antigua and Barbuda"
                {!! $teacher->country == 'Antigua and Barbuda'?'selected':'' !!}>
                {!! trans('countries.Antigua and Barbuda') !!}
            </option>
            <option value="Argentina"
                {!! $teacher->country == 'Argentina'?'selected':'' !!}>
                {!! trans('countries.Argentina') !!}
            </option>
            <option value="Armenia"
                {!! $teacher->country == 'Armenia'?'selected':'' !!}>
                {!! trans('countries.Armenia') !!}
            </option>
            <option value="Aruba"
                {!! $teacher->country == 'Aruba'?'selected':'' !!}>
                {!! trans('countries.Aruba') !!}
            </option>
            <option value="Australia"
                {!! $teacher->country == 'Australia'?'selected':'' !!}>
                {!! trans('countries.Australia') !!}
            </option>
            <option value="Austria"
                {!! $teacher->country == 'Austria'?'selected':'' !!}>
                {!! trans('countries.Austria') !!}
            </option>
            <option value="Azerbaijan"
                {!! $teacher->country == 'Azerbaijan'?'selected':'' !!}>
                {!! trans('countries.Azerbaijan') !!}
            </option>
            <option value="Bahamas"
                {!! $teacher->country == 'Bahamas'?'selected':'' !!}>
                {!! trans('countries.Bahamas') !!}
            </option>
            <option value="Bahrain"
                {!! $teacher->country == 'Bahrain'?'selected':'' !!}>
                {!! trans('countries.Bahrain') !!}
            </option>
            <option value="Bangladesh"
                {!! $teacher->country == 'Bangladesh'?'selected':'' !!}>
                {!! trans('countries.Bangladesh') !!}
            </option>
            <option value="Barbados"
                {!! $teacher->country == 'Barbados'?'selected':'' !!}>
                {!! trans('countries.Barbados') !!}
            </option>
            <option value="Belarus"
                {!! $teacher->country == 'Belarus'?'selected':'' !!}>
                {!! trans('countries.Belarus') !!}
            </option>
            <option value="Belgium"
                {!! $teacher->country == 'Belgium'?'selected':'' !!}>
                {!! trans('countries.Belgium') !!}
            </option>
            <option value="Belize"
                {!! $teacher->country == 'Belize'?'selected':'' !!}>
                {!! trans('countries.Belize') !!}
            </option>
            <option value="Benin"
                {!! $teacher->country == 'Benin'?'selected':'' !!}>
                {!! trans('countries.Benin') !!}
            </option>
            <option value="Bermuda"
                {!! $teacher->country == 'Bermuda'?'selected':'' !!}>
                {!! trans('countries.Bermuda') !!}
            </option>
            <option value="Bhutan"
                {!! $teacher->country == 'Bhutan'?'selected':'' !!}>
                {!! trans('countries.Bhutan') !!}
            </option>
            <option value="Bolivia"
                {!! $teacher->country == 'Bolivia'?'selected':'' !!}>
                {!! trans('countries.Bolivia') !!}
            </option>
            <option value="Sint Eustatius and Saba"
                {!! $teacher->country == 'Sint Eustatius and Saba'?'selected':'' !!}>
                {!! trans('countries.Bonaire, Sint Eustatius and Saba') !!}
            </option>
            <option value="Bosnia and Herzegovina"
                {!! $teacher->country == 'Bosnia and Herzegovina'?'selected':'' !!}>
                {!! trans('countries.Bosnia and Herzegovina') !!}
            </option>
            <option value="Botswana"
                {!! $teacher->country == 'Botswana'?'selected':'' !!}>
                {!! trans('countries.Botswana') !!}
            </option>
            <option value="Bouvet Island"
                {!! $teacher->country == 'Bouvet Island'?'selected':'' !!}>
                {!! trans('countries.Bouvet Island') !!}
            </option>
            <option value="Brazil"
                {!! $teacher->country == 'Brazil'?'selected':'' !!}>
                {!! trans('countries.Brazil') !!}
            </option>
            <option value="British Indian Ocean Territory"
                {!! $teacher->country == 'British Indian Ocean Territory'?'selected':'' !!}>
                {!! trans('countries.British Indian Ocean Territory') !!}
            </option>
            <option value="Brunei Darussalam"
                {!! $teacher->country == 'Brunei Darussalam'?'selected':'' !!}>
                {!! trans('countries.Brunei Darussalam') !!}
            </option>
            <option value="Bulgaria"
                {!! $teacher->country == 'Bulgaria'?'selected':'' !!}>
                {!! trans('countries.Bulgaria') !!}
            </option>
            <option value="Burkina Faso"
                {!! $teacher->country == 'Burkina Faso'?'selected':'' !!}>
                {!! trans('countries.Burkina Faso') !!}
            </option>
            <option value="Burundi"
                {!! $teacher->country == 'Burundi'?'selected':'' !!}>
                {!! trans('countries.Burundi') !!}
            </option>
            <option value="Cambodia"
                {!! $teacher->country == 'Cambodia'?'selected':'' !!}>
                {!! trans('countries.Cambodia') !!}
            </option>
            <option value="Cameroon"
                {!! $teacher->country == 'Cameroon'?'selected':'' !!}>
                {!! trans('countries.Cameroon') !!}
            </option>
            <option value="Canada"
                {!! $teacher->country == 'Canada'?'selected':'' !!}>
                {!! trans('countries.Canada') !!}
            </option>
            <option value="CV"
                {!! $teacher->country == 'Cape Verde'?'selected':'' !!}>
                {!! trans('countries.Cape Verde') !!}
            </option>
            <option value="Cayman Islands"
                {!! $teacher->country == 'Cayman Islands'?'selected':'' !!}>
                {!! trans('countries.Cayman Islands') !!}
            </option>
            <option value="Central African Republic"
                {!! $teacher->country == 'Central African Republic'?'selected':'' !!}>
                {!! trans('countries.Central African Republic') !!}
            </option>
            <option value="Chad"
                {!! $teacher->country == 'Chad'?'selected':'' !!}>
                {!! trans('countries.Chad') !!}
            </option>
            <option value="Chile"
                {!! $teacher->country == 'Chile'?'selected':'' !!}>
                {!! trans('countries.Chile') !!}
            </option>
            <option value="China"
                {!! $teacher->country == 'China'?'selected':'' !!}>
                {!! trans('countries.China') !!}
            </option>
            <option value="Christmas Island"
                {!! $teacher->country == 'Christmas Island'?'selected':'' !!}>
                {!! trans('countries.Christmas Island') !!}
            </option>
            <option value="Cocos (Keeling) Islands"
                {!! $teacher->country == 'Cocos (Keeling) Islands'?'selected':'' !!}>
                {!! trans('countries.Cocos (Keeling) Islands') !!}
            </option>
            <option value="Colombia"
                {!! $teacher->country == 'Colombia'?'selected':'' !!}>
                {!! trans('countries.Colombia') !!}
            </option>
            <option value="Comoros"
                {!! $teacher->country == 'Comoros'?'selected':'' !!}>
                {!! trans('countries.Comoros') !!}
            </option>
            <option value="Congo"
                {!! $teacher->country == 'Congo'?'selected':'' !!}>
                {!! trans('countries.Congo') !!}
            </option>
            <option value="Congo, Democratic Republic of the Congo"
                {!! $teacher->country == 'Congo, Democratic Republic of the Congo'?'selected':'' !!}>
                {!! trans('countries.Congo, Democratic Republic of the Congo') !!}
            </option>
            <option value="Cook Islands"
                {!! $teacher->country == 'Cook Islands'?'selected':'' !!}>
                {!! trans('countries.Cook Islands') !!}
            </option>
            <option value="Costa Rica"
                {!! $teacher->country == 'Costa Rica'?'selected':'' !!}>
                {!! trans('countries.Costa Rica') !!}
            </option>
            <option value="Cote DIvoire"
                {!! $teacher->country == 'Cote DIvoire'?'selected':'' !!}>
                {!! trans('countries.Cote DIvoire') !!}
            </option>
            <option value="Croatia"
                {!! $teacher->country == 'Croatia'?'selected':'' !!}>
                {!! trans('countries.Croatia') !!}
            </option>
            <option value="Cuba"
                {!! $teacher->country == 'Cuba'?'selected':'' !!}>
                {!! trans('countries.Cuba') !!}
            </option>
            <option value="Curacao"
                {!! $teacher->country == 'Curacao'?'selected':'' !!}>
                {!! trans('countries.Curacao') !!}
            </option>
            <option value="Cyprus"
                {!! $teacher->country == 'Cyprus'?'selected':'' !!}>
                {!! trans('countries.Cyprus') !!}
            </option>
            <option value="Czech Republic"
                {!! $teacher->country =='Czech Republic'?'selected':'' !!}>
                {!! trans('countries.Czech Republic') !!}
            </option>
            <option value="Denmark"
                {!! $teacher->country == 'Denmark'?'selected':'' !!}>
                {!! trans('countries.Denmark') !!}
            </option>
            <option value="Djibouti"
                {!! $teacher->country == 'Djibouti'?'selected':'' !!}>
                {!! trans('countries.Djibouti') !!}
            </option>
            <option value="Dominica"
                {!! $teacher->country == 'Dominica'?'selected':'' !!}>
                {!! trans('countries.Dominica') !!}
            </option>
            <option value="Dominican Republic"
                {!! $teacher->country == 'Dominican Republic'?'selected':'' !!}>
                {!! trans('countries.Dominican Republic') !!}
            </option>
            <option value="Ecuador"
                {!! $teacher->country == 'Ecuador'?'selected':'' !!}>
                {!! trans('countries.Ecuador') !!}
            </option>
            <option value="Egypt"
                {!! $teacher->country == 'Egypt'?'selected':'' !!}>
                {!! trans('countries.Egypt') !!}
            </option>
            <option value="El Salvador"
                {!! $teacher->country == 'El Salvador'?'selected':'' !!}>
                {!! trans('countries.El Salvador') !!}
            </option>
            <option value="Equatorial Guinea"
                {!! $teacher->country == 'Equatorial Guinea'?'selected':'' !!}>
                {!! trans('countries.Equatorial Guinea') !!}
            </option>
            <option value="Eritrea"
                {!! $teacher->country == 'Eritrea'?'selected':'' !!}>
                {!! trans('countries.Eritrea') !!}
            </option>
            <option value="Estonia"
                {!! $teacher->country == 'Estonia'?'selected':'' !!}>
                {!! trans('countries.Estonia') !!}
            </option>
            <option value="Ethiopia"
                {!! $teacher->country == 'Ethiopia'?'selected':'' !!}>
                {!! trans('countries.Ethiopia') !!}
            </option>
            <option value="Falkland Islands(Malvinas)"
                {!! $teacher->country == 'Falkland Islands(Malvinas)'?'selected':'' !!}>
                {!! trans('countries.Falkland Islands(Malvinas)') !!}
            </option>
            <option value="Faroe Islands"
                {!! $teacher->country == 'Faroe Islands'?'selected':'' !!}>
                {!! trans('countries.Faroe Islands') !!}
            </option>
            <option value="Fiji"
                {!! $teacher->country == 'Fiji'?'selected':'' !!}>
                {!! trans('countries.Fiji') !!}
            </option>
            <option value="Finland"
                {!! $teacher->country == 'Finland'?'selected':'' !!}>
                {!! trans('countries.Finland') !!}
            </option>
            <option value="France"
                {!! $teacher->country == 'France'?'selected':'' !!}>
                {!! trans('countries.France') !!}
            </option>
            <option value="French Guiana"
                {!! $teacher->country == 'French Guiana'?'selected':'' !!}>
                {!! trans('countries.French Guiana') !!}
            </option>
            <option value="French Polynesia"
                {!! $teacher->country == 'French Polynesia'?'selected':'' !!}>
                {!! trans('countries.French Polynesia') !!}
            </option>
            <option value="French Southern Territories"
                {!! $teacher->country == 'French Southern Territories'?'selected':'' !!}>
                {!! trans('countries.French Southern Territories') !!}
            </option>
            <option value="Gabon"
                {!! $teacher->country == 'Gabon'?'selected':'' !!}>
                {!! trans('countries.Gabon') !!}
            </option>
            <option value="Gambia"
                {!! $teacher->country == 'Gambia'?'selected':'' !!}>
                {!! trans('countries.Gambia') !!}
            </option>
            <option value="Georgia"
                {!! $teacher->country == 'Georgia'?'selected':'' !!}>
                {!! trans('countries.Georgia') !!}
            </option>
            <option value="Germany"
                {!! $teacher->country == 'Germany'?'selected':'' !!}>
                {!! trans('countries.Germany') !!}
            </option>
            <option value="Ghana"
                {!! $teacher->country == 'Ghana'?'selected':'' !!}>
                {!! trans('countries.Ghana') !!}
            </option>
            <option value="Gibraltar"
                {!! $teacher->country == 'Gibraltar'?'selected':'' !!}>
                {!! trans('countries.Gibraltar') !!}
            </option>
            <option value="Greece"
                {!! $teacher->country == 'Greece'?'selected':'' !!}>
                {!! trans('countries.Greece') !!}
            </option>
            <option value="Greenland"
                {!! $teacher->country == 'Greenland'?'selected':'' !!}>
                {!! trans('countries.Greenland') !!}
            </option>
            <option value="Grenada"
                {!! $teacher->country == 'Grenada'?'selected':'' !!}>
                {!! trans('countries.Grenada') !!}
            </option>
            <option value="Guadeloupe"
                {!! $teacher->country == 'Guadeloupe'?'selected':'' !!}>
                {!! trans('countries.Guadeloupe') !!}
            </option>
            <option value="Guam"
                {!! $teacher->country == 'Guam'?'selected':'' !!}>
                {!! trans('countries.Guam') !!}
            </option>
            <option value="Guatemala"
                {!! $teacher->country == 'Guatemala'?'selected':'' !!}>
                {!! trans('countries.Guatemala') !!}
            </option>
            <option value="Guernsey"
                {!! $teacher->country == 'Guernsey'?'selected':'' !!}>
                {!! trans('countries.Guernsey') !!}
            </option>
            <option value="Guinea"
                {!! $teacher->country == 'Guinea'?'selected':'' !!}>
                {!! trans('countries.Guinea') !!}
            </option>
            <option value="Guinea-Bissau"
                {!! $teacher->country == 'Guinea-Bissau'?'selected':'' !!}>
                {!! trans('countries.Guinea-Bissau') !!}
            </option>
            <option value="Guyana"
                {!! $teacher->country == 'Guyana'?'selected':'' !!}>
                {!! trans('countries.Guyana') !!}
            </option>
            <option value="Haiti"
                {!! $teacher->country == 'Haiti'?'selected':'' !!}>
                {!! trans('countries.Haiti') !!}
            </option>
            <option value="Heard Island and McDonald Islands"
                {!! $teacher->country == 'Heard Island and McDonald Islands'?'selected':'' !!}>
                {!! trans('countries.Heard Island and McDonald Islands') !!}
            </option>
            <option value="Holy See(Vatican City State)"
                {!! $teacher->country == 'Holy See(Vatican City State)'?'selected':'' !!}>
                {!! trans('countries.Holy See(Vatican City State)') !!}
            </option>
            <option value="Honduras"
                {!! $teacher->country == 'Honduras'?'selected':'' !!}>
                {!! trans('countries.Honduras') !!}
            </option>
            <option value="Hong Kong"
                {!! $teacher->country == 'Hong Kong'?'selected':'' !!}>
                {!! trans('countries.Hong Kong') !!}
            </option>
            <option value="Hungary"
                {!! $teacher->country == 'Hungary'?'selected':'' !!}>
                {!! trans('countries.Hungary') !!}
            </option>
            <option value="Iceland"
                {!! $teacher->country == 'Iceland'?'selected':'' !!}>
                {!! trans('countries.Iceland') !!}
            </option>
            <option value="India"
                {!! $teacher->country == 'India'?'selected':'' !!}>
                {!! trans('countries.India') !!}
            </option>
            <option value="Indonesia"
                {!! $teacher->country == 'Indonesia'?'selected':'' !!}>
                {!! trans('countries.Indonesia') !!}
            </option>
            <option value="Iran, Islamic Republic of"
                {!! $teacher->country == 'Iran, Islamic Republic of'?'selected':'' !!}>
                {!! trans('countries.Iran, Islamic Republic of') !!}
            </option>
            <option value="Iraq"
                {!! $teacher->country == 'Iraq'?'selected':'' !!}>
                {!! trans('countries.Iraq') !!}
            </option>
            <option value="Ireland"
                {!! $teacher->country == 'Ireland'?'selected':'' !!}>
                {!! trans('countries.Ireland') !!}
            </option>
            <option value="Isle of Man"
                {!! $teacher->country == 'Isle of Man'?'selected':'' !!}>
                {!! trans('countries.Isle of Man') !!}
            </option>
            <option value="Israel"
                {!! $teacher->country == 'Israel'?'selected':'' !!}>
                {!! trans('countries.Israel') !!}
            </option>
            <option value="Italy"
                {!! $teacher->country == 'Italy'?'selected':'' !!}>
                {!! trans('countries.Italy') !!}
            </option>
            <option value="Jamaica"
                {!! $teacher->country == 'Jamaica'?'selected':'' !!}>
                {!! trans('countries.Jamaica') !!}
            </option>
            <option value="Japan"
                {!! $teacher->country == 'Japan'?'selected':'' !!}>
                {!! trans('countries.Japan') !!}
            </option>
            <option value="Jersey"
                {!! $teacher->country == 'Jersey'?'selected':'' !!}>
                {!! trans('countries.Jersey') !!}
            </option>
            <option value="Jordan"
                {!! $teacher->country == 'Jordan'?'selected':'' !!}>
                {!! trans('countries.Jordan') !!}
            </option>
            <option value="Kazakhstan"
                {!! $teacher->country == 'Kazakhstan'?'selected':'' !!}>
                {!! trans('countries.Kazakhstan') !!}
            </option>
            <option value="Kenya"
                {!! $teacher->country == 'Kenya'?'selected':'' !!}>
                {!! trans('countries.Kenya') !!}
            </option>
            <option value="Kiribati"
                {!! $teacher->country == 'Kiribati'?'selected':'' !!}>
                {!! trans('countries.Kiribati') !!}
            </option>
            <option value="Korea,Democratic Peoples Republic of"
                {!! $teacher->country == 'Korea,Democratic Peoples Republic of'?'selected':'' !!}>
                {!! trans('countries.Korea,Democratic Peoples Republic of') !!}
            </option>
            <option value="Korea, Republic of"
                {!! $teacher->country == 'Korea, Republic of'?'selected':'' !!}>
                {!! trans('countries.Korea, Republic of') !!}
            </option>
            <option value="Kosovo"
                {!! $teacher->country == 'Kosovo'?'selected':'' !!}>
                {!! trans('countries.Kosovo') !!}
            </option>
            <option value="Kuwait"
                {!! $teacher->country =='Kuwait'?'selected':'' !!}>
                {!! trans('countries.Kuwait') !!}
            </option>
            <option value="Kyrgyzstan"
                {!! $teacher->country == 'Kyrgyzstan'?'selected':'' !!}>
                {!! trans('countries.Kyrgyzstan') !!}
            </option>
            <option value="Lao Peoples Democratic Republic"
                {!! $teacher->country == 'Lao Peoples Democratic Republic'?'selected':'' !!}>
                {!! trans('countries.Lao Peoples Democratic Republic') !!}
            </option>
            <option value="Latvia"
                {!! $teacher->country == 'Latvia'?'selected':'' !!}>
                {!! trans('countries.Latvia') !!}
            </option>
            <option value="Lebanon"
                {!! $teacher->country == 'Lebanon'?'selected':'' !!}>
                {!! trans('countries.Lebanon') !!}
            </option>
            <option value="Lesotho"
                {!! $teacher->country == 'Lesotho'?'selected':'' !!}>
                {!! trans('countries.Lesotho') !!}
            </option>
            <option value="Liberia"
                {!! $teacher->country == 'Liberia'?'selected':'' !!}>
                {!! trans('countries.Liberia') !!}
            </option>
            <option value="Libyan Arab Jamahiriya"
                {!! $teacher->country == 'Libyan Arab Jamahiriya'?'selected':'' !!}>
                {!! trans('countries.Libyan Arab Jamahiriya') !!}
            </option>
            <option value="Liechtenstein"
                {!! $teacher->country == 'Liechtenstein'?'selected':'' !!}>
                {!! trans('countries.Liechtenstein') !!}
            </option>
            <option value="Lithuania"
                {!! $teacher->country == 'Lithuania'?'selected':'' !!}>
                {!! trans('countries.Lithuania') !!}
            </option>
            <option value="Luxembourg"
                {!! $teacher->country == 'Luxembourg'?'selected':'' !!}>
                {!! trans('countries.Luxembourg') !!}
            </option>
            <option value="Macao"
                {!! $teacher->country == 'Macao'?'selected':'' !!}>
                {!! trans('countries.Macao') !!}
            </option>
            <option value="Macedonia, the Former Yugoslav Republic of"
                {!! $teacher->country == 'Macedonia, the Former Yugoslav Republic of'?'selected':'' !!}>
                {!! trans('countries.Macedonia, the Former Yugoslav Republic of') !!}
            </option>
            <option value="Madagascar"
                {!! $teacher->country == 'Madagascar'?'selected':'' !!}>
                {!! trans('countries.Madagascar') !!}
            </option>
            <option value="Malawi"
                {!! $teacher->country == 'Malawi'?'selected':'' !!}>
                {!! trans('countries.Malawi') !!}
            </option>
            <option value="Malaysia"
                {!! $teacher->country == 'Malaysia'?'selected':'' !!}>
                {!! trans('countries.Malaysia') !!}
            </option>
            <option value="Maldives"
                {!! $teacher->country == 'Maldives'?'selected':'' !!}>
                {!! trans('countries.Maldives') !!}
            </option>
            <option value="Mali"
                {!! $teacher->country == 'Mali'?'selected':'' !!}>
                {!! trans('countries.Mali') !!}
            </option>
            <option value="Malta"
                {!! $teacher->country == 'Malta'?'selected':'' !!}>
                {!! trans('countries.Malta') !!}
            </option>
            <option value="Marshall Islands"
                {!! $teacher->country == 'Marshall Islands'?'selected':'' !!}>
                {!! trans('countries.Marshall Islands') !!}
            </option>
            <option value="Martinique"
                {!! $teacher->country == 'Martinique'?'selected':'' !!}>
                {!! trans('countries.Martinique') !!}
            </option>
            <option value="Mauritania"
                {!! $teacher->country == 'Mauritania'?'selected':'' !!}>
                {!! trans('countries.Mauritania') !!}
            </option>
            <option value="Mauritius"
                {!! $teacher->country == 'Mauritius'?'selected':'' !!}>
                {!! trans('countries.Mauritius') !!}
            </option>
            <option value="Mayotte"
                {!! $teacher->country == 'Mayotte'?'selected':'' !!}>
                {!! trans('countries.Mayotte') !!}
            </option>
            <option value="Mexico"
                {!! $teacher->country =='Mexico'?'selected':'' !!}>
                {!! trans('countries.Mexico') !!}
            </option>
            <option value="Federated States of"
                {!! $teacher->country == 'Federated States of'?'selected':'' !!}>
                {!! trans('countries.Micronesia, Federated States of') !!}
            </option>
            <option value="Moldova, Republic of"
                {!! $teacher->country == 'Moldova, Republic of'?'selected':'' !!}>
                {!! trans('countries.Moldova, Republic of') !!}
            </option>
            <option value="Monaco"
                {!! $teacher->country == 'Monaco'?'selected':'' !!}>
                {!! trans('countries.Monaco') !!}
            </option>
            <option value="Mongolia"
                {!! $teacher->country == 'Mongolia'?'selected':'' !!}>
                {!! trans('countries.Mongolia') !!}</option>
            <option value="Montenegro"
                {!! $teacher->country == 'Montenegro'?'selected':'' !!}>
                {!! trans('countries.Montenegro') !!}
            </option>
            <option value="Montserrat"
                {!! $teacher->country == 'Montserrat'?'selected':'' !!}>
                {!! trans('countries.Montserrat') !!}
            </option>
            <option value="Morocco"
                {!! $teacher->country == 'Morocco'?'selected':'' !!}>
                {!! trans('countries.Morocco') !!}
            </option>
            <option value="Mozambique"
                {!! $teacher->country == 'Mozambique'?'selected':'' !!}>
                {!! trans('countries.Mozambique') !!}
            </option>
            <option value="Myanmar"
                {!! $teacher->country == 'Myanmar'?'selected':'' !!}>
                {!! trans('countries.Myanmar') !!}
            </option>
            <option value="Namibia"
                {!! $teacher->country == 'Namibia'?'selected':'' !!}>
                {!! trans('countries.Namibia') !!}
            </option>
            <option value="Nauru"
                {!! $teacher->country == 'Nauru'?'selected':'' !!}>
                {!! trans('countries.Nauru') !!}
            </option>
            <option value="Nepal"
                {!! $teacher->country == 'Nepal'?'selected':'' !!}>
                {!! trans('countries.Nepal') !!}
            </option>
            <option value="Netherlands"
                {!! $teacher->country == 'Netherlands'?'selected':'' !!}>
                {!! trans('countries.Netherlands') !!}
            </option>
            <option value="Netherlands Antilles"
                {!! $teacher->country == 'Netherlands Antilles'?'selected':'' !!}>
                {!! trans('countries.Netherlands Antilles') !!}
            </option>
            <option value="New Caledonia"
                {!! $teacher->country == 'New Caledonia'?'selected':'' !!}>
                {!! trans('countries.New Caledonia') !!}
            </option>
            <option value="New Zealand"
                {!! $teacher->country == 'New Zealand'?'selected':'' !!}>
                {!! trans('countries.New Zealand') !!}
            </option>
            <option value="Nicaragua"
                {!! $teacher->country == 'Nicaragua'?'selected':'' !!}>
                {!! trans('countries.Nicaragua') !!}
            </option>
            <option value="Niger"
                {!! $teacher->country == 'Niger'?'selected':'' !!}>
                {!! trans('countries.Niger') !!}
            </option>
            <option value="Nigeria"
                {!! $teacher->country == 'Nigeria'?'selected':'' !!}>
                {!! trans('countries.Nigeria') !!}
            </option>
            <option value="Niue"
                {!! $teacher->country == 'Niue'?'selected':'' !!}>
                {!! trans('countries.Niue') !!}
            </option>
            <option value="Norfolk Island"
                {!! $teacher->country == 'Norfolk Island'?'selected':'' !!}>
                {!! trans('countries.Norfolk Island') !!}
            </option>
            <option value="Northern Mariana Islands"
                {!! $teacher->country == 'Northern Mariana Islands'?'selected':'' !!}>
                {!! trans('countries.Northern Mariana Islands') !!}
            </option>
            <option value="Norway"
                {!! $teacher->country == 'Norway'?'selected':'' !!}>
                {!! trans('countries.Norway') !!}
            </option>
            <option value="Oman"
                {!! $teacher->country == 'Oman'?'selected':'' !!}>
                {!! trans('countries.Oman') !!}</option>
            <option value="Pakistan"
                {!! $teacher->country == 'Pakistan'?'selected':'' !!}>
                {!! trans('countries.Pakistan') !!}
            </option>
            <option value="Palau"
                {!! $teacher->country == 'Palau'?'selected':'' !!}>
                {!! trans('countries.Palau') !!}
            </option>
            <option value="Palestinian Territory, Occupied"
                {!! $teacher->country == 'Palestinian Territory, Occupied'?'selected':'' !!}>
                {!! trans('countries.Palestinian Territory, Occupied') !!}
            </option>
            <option value="Panama"
                {!! $teacher->country == 'Panama'?'selected':'' !!}>
                {!! trans('countries.Panama') !!}
            </option>
            <option value="Papua New Guinea"
                {!! $teacher->country == 'Papua New Guinea'?'selected':'' !!}>
                {!! trans('countries.Papua New Guinea') !!}
            </option>
            <option value="Paraguay"
                {!! $teacher->country == 'Paraguay'?'selected':'' !!}>
                {!! trans('countries.Paraguay') !!}
            </option>
            <option value="Peru"
                {!! $teacher->country == 'Peru'?'selected':'' !!}>
                {!! trans('countries.Peru') !!}
            </option>
            <option value="Philippines"
                {!! $teacher->country == 'Philippines'?'selected':'' !!}>
                {!! trans('countries.Philippines') !!}
            </option>
            <option value="Pitcairn"
                {!! $teacher->country == 'Pitcairn'?'selected':'' !!}>
                {!! trans('countries.Pitcairn') !!}
            </option>
            <option value="Poland"
                {!! $teacher->country == 'Poland'?'selected':'' !!}>
                {!! trans('countries.Poland') !!}
            </option>
            <option value="Portugal"
                {!! $teacher->country == 'Portugal'?'selected':'' !!}>
                {!! trans('countries.Portugal') !!}
            </option>
            <option value="Puerto Rico"
                {!! $teacher->country == 'Puerto Rico'?'selected':'' !!}>
                {!! trans('countries.Puerto Rico') !!}
            </option>
            <option value="Qatar"
                {!! $teacher->country == 'Qatar'?'selected':'' !!}>
                {!! trans('countries.Qatar') !!}
            </option>
            <option value="Reunion"
                {!! $teacher->country == 'Reunion'?'selected':'' !!}>
                {!! trans('countries.Reunion') !!}
            </option>
            <option value="Romania"
                {!! $teacher->country == 'Romania'?'selected':'' !!}>
                {!! trans('countries.Romania') !!}
            </option>
            <option value="Russian Federation"
                {!! $teacher->country == 'Russian Federation'?'selected':'' !!}>
                {!! trans('countries.Russian Federation') !!}
            </option>
            <option value="Rwanda"
                {!! $teacher->country == 'Rwanda'?'selected':'' !!}>
                {!! trans('countries.Rwanda') !!}
            </option>
            <option value="Saint Barthelemy"
                {!! $teacher->country == 'Saint Barthelemy'?'selected':'' !!}>
                {!! trans('countries.Saint Barthelemy') !!}
            </option>
            <option value="Saint Helena"
                {!! $teacher->country =='Saint Helena'?'selected':'' !!}>
                {!! trans('countries.Saint Helena') !!}
            </option>
            <option value="Saint Kitts and Nevis"
                {!! $teacher->country == 'Saint Kitts and Nevis'?'selected':'' !!}>
                {!! trans('countries.Saint Kitts and Nevis') !!}
            </option>
            <option value="Saint Lucia"
                {!! $teacher->country == 'Saint Lucia'?'selected':'' !!}>
                {!! trans('countries.Saint Lucia') !!}
            </option>
            <option value="Saint Martin"
                {!! $teacher->country == 'Saint Martin'?'selected':'' !!}>
                {!! trans('countries.Saint Martin') !!}
            </option>
            <option value="Saint Pierre and Miquelon"
                {!! $teacher->country == 'Saint Pierre and Miquelon'?'selected':'' !!}>
                {!! trans('countries.Saint Pierre and Miquelon') !!}
            </option>
            <option value="Saint Vincent and the Grenadines"
                {!! $teacher->country == 'Saint Vincent and the Grenadines'?'selected':'' !!}>
                {!! trans('countries.Saint Vincent and the Grenadines') !!}
            </option>
            <option value="Samoa"
                {!! $teacher->country == 'Samoa'?'selected':'' !!}>
                {!! trans('countries.Samoa') !!}
            </option>
            <option value="San Marino"
                {!! $teacher->country == 'San Marino'?'selected':'' !!}>
                {!! trans('countries.San Marino') !!}
            </option>
            <option value="Sao Tome and Principe"
                {!! $teacher->country == 'Sao Tome and Principe'?'selected':'' !!}>
                {!! trans('countries.Sao Tome and Principe') !!}
            </option>
            <option value="Saudi Arabia"
                {!! $teacher->country =='Saudi Arabia'?'selected':'' !!}>
                {!! trans('countries.Saudi Arabia') !!}
            </option>
            <option value="Senegal"
                {!! $teacher->country == 'Senegal'?'selected':'' !!}>
                {!! trans('countries.Senegal') !!}
            </option>
            <option value="Serbia"
                {!! $teacher->country == 'Serbia'?'selected':'' !!}>
                {!! trans('countries.Serbia') !!}
            </option>
            <option value="Serbia and Montenegro"
                {!! $teacher->country == 'Serbia and Montenegro'?'selected':'' !!}>
                {!! trans('countries.Serbia and Montenegro') !!}
            </option>
            <option value="Seychelles"
                {!! $teacher->country == 'Seychelles'?'selected':'' !!}>
                {!! trans('countries.Seychelles') !!}
            </option>
            <option value="Sierra Leone"
                {!! $teacher->country == 'Sierra Leone'?'selected':'' !!}>
                {!! trans('countries.Sierra Leone') !!}
            </option>
            <option value="Singapore"
                {!! $teacher->country == 'Singapore'?'selected':'' !!}>
                {!! trans('countries.Singapore') !!}
            </option>
            <option value="St Martin"
                {!! $teacher->country == 'St Martin'?'selected':'' !!}>
                {!! trans('countries.St Martin') !!}
            </option>
            <option value="Slovakia"
                {!! $teacher->country == 'Slovakia'?'selected':'' !!}>
                {!! trans('countries.Slovakia') !!}
            </option>
            <option value="Slovenia"
                {!! $teacher->country == 'Slovenia'?'selected':'' !!}>
                {!! trans('countries.Slovenia') !!}
            </option>
            <option value="Solomon Islands"
                {!! $teacher->country == 'Solomon Islands'?'selected':'' !!}>
                {!! trans('countries.Solomon Islands') !!}
            </option>
            <option value="Somalia"
                {!! $teacher->country == 'Somalia'?'selected':'' !!}>
                {!! trans('countries.Somalia') !!}
            </option>
            <option value="ZA"
                {!! $teacher->country == 'South Africa'?'selected':'' !!}>
                {!! trans('countries.South Africa') !!}
            </option>
            <option value="South Georgia and the South Sandwich Islands"
                {!! $teacher->country == 'South Georgia and the South Sandwich Islands'?'selected':'' !!}>
                {!! trans('countries.South Georgia and the South Sandwich Islands') !!}
            </option>
            <option value="South Sudan"
                {!! $teacher->country == 'South Sudan'?'selected':'' !!}>
                {!! trans('countries.South Sudan') !!}
            </option>
            <option value="Spain"
                {!! $teacher->country == 'Spain'?'selected':'' !!}>
                {!! trans('countries.Spain') !!}
            </option>
            <option value="Sri Lanka"
                {!! $teacher->country == 'Sri Lanka'?'selected':'' !!}>
                {!! trans('countries.Sri Lanka') !!}
            </option>
            <option value="Sudan"
                {!! $teacher->country == 'Sudan'?'selected':'' !!}>
                {!! trans('countries.Sudan') !!}
            </option>
            <option value="Suriname"
                {!! $teacher->country == 'Suriname'?'selected':'' !!}>
                {!! trans('countries.Suriname') !!}
            </option>
            <option value="Svalbard and Jan Mayen"
                {!! $teacher->country == 'Svalbard and Jan Mayen'?'selected':'' !!}>
                {!! trans('countries.Svalbard and Jan Mayen') !!}
            </option>
            <option value="Swaziland"
                {!! $teacher->country == 'Swaziland'?'selected':'' !!}>
                {!! trans('countries.Swaziland') !!}
            </option>
            <option value="Sweden"
                {!! $teacher->country == 'Sweden'?'selected':'' !!}>
                {!! trans('countries.Sweden') !!}
            </option>
            <option value="Switzerland"
                {!! $teacher->country == 'Switzerland'?'selected':'' !!}>
                {!! trans('countries.Switzerland') !!}
            </option>
            <option value="Syrian Arab Republic"
                {!! $teacher->country == 'Syrian Arab Republic'?'selected':'' !!}>
                {!! trans('countries.Syrian Arab Republic') !!}
            </option>
            <option value="Taiwan, Province of China"
                {!! $teacher->country == 'Taiwan, Province of China'?'selected':'' !!}>
                {!! trans('countries.Taiwan, Province of China') !!}
            </option>
            <option value="Tajikistan"
                {!! $teacher->country == 'Tajikistan'?'selected':'' !!}>
                {!! trans('countries.Tajikistan') !!}
            </option>
            <option value="Tanzania, United Republic of"
                {!! $teacher->country == 'Tanzania, United Republic of'?'selected':'' !!}>
                {!! trans('countries.Tanzania, United Republic of') !!}
            </option>
            <option value="Thailand"
                {!! $teacher->country == 'Thailand'?'selected':'' !!}>
                {!! trans('countries.Thailand') !!}
            </option>
            <option value="Timor-Leste"
                {!! $teacher->country == 'Timor-Leste'?'selected':'' !!}>
                {!! trans('countries.Timor-Leste') !!}
            </option>
            <option value="Togo"
                {!! $teacher->country == 'Togo'?'selected':'' !!}>
                {!! trans('countries.Togo') !!}
            </option>
            <option value="Tokelau"
                {!! $teacher->country == 'Tokelau'?'selected':'' !!}>
                {!! trans('countries.Tokelau') !!}
            </option>
            <option value="Tonga"
                {!! $teacher->country == 'Tonga'?'selected':'' !!}>
                {!! trans('countries.Tonga') !!}
            </option>
            <option value="Trinidad and Tobago"
                {!! $teacher->country == 'Trinidad and Tobago'?'selected':'' !!}>
                {!! trans('countries.Trinidad and Tobago') !!}
            </option>
            <option
                value="Tunisia"
                {!! $teacher->country == 'Tunisia'?'selected':'' !!}>
                {!! trans('countries.Tunisia') !!}
            </option>
            <option value="Turkey"
                {!! $teacher->country == 'Turkey'?'selected':'' !!}>
                {!! trans('countries.Turkey') !!}
            </option>
            <option value="Turkmenistan"
                {!! $teacher->country == 'Turkmenistan'?'selected':'' !!}>
                {!! trans('countries.Turkmenistan') !!}
            </option>
            <option value="Turks and Caicos Islands"
                {!! $teacher->country == 'Turks and Caicos Islands'?'selected':'' !!}>
                {!! trans('countries.Turks and Caicos Islands') !!}
            </option>
            <option value="Tuvalu"
                {!! $teacher->country == 'Tuvalu'?'selected':'' !!}>
                {!! trans('countries.Tuvalu') !!}
            </option>
            <option value="Uganda"
                {!! $teacher->country == 'Uganda'?'selected':'' !!}>
                {!! trans('countries.Uganda') !!}
            </option>
            <option value="UA"
                {!! $teacher->country == 'Ukraine'?'selected':'' !!}>
                {!! trans('countries.Ukraine') !!}
            </option>
            <option value="United Arab Emirates"
                {!! $teacher->country == 'United Arab Emirates'?'selected':'' !!}>
                {!! trans('countries.United Arab Emirates') !!}
            </option>
            <option value="United Kingdom"
                {!! $teacher->country == 'United Kingdom'?'selected':'' !!}>
                {!! trans('countries.United Kingdom') !!}
            </option>
            <option value="United States"
                {!! $teacher->country == 'United States'?'selected':'' !!}>
                {!! trans('countries.United States') !!}
            </option>
            <option value="United States Minor Outlying Islands"
                {!! $teacher->country == 'United States Minor Outlying Islands'?'selected':'' !!}>
                {!! trans('countries.United States Minor Outlying Islands') !!}
            </option>
            <option value="Uruguay"
                {!! $teacher->country == 'Uruguay'?'selected':'' !!}>
                {!! trans('countries.Uruguay') !!}
            </option>
            <option value="Uzbekistan"
                {!! $teacher->country == 'Uzbekistan'?'selected':'' !!}>
                {!! trans('countries.Uzbekistan') !!}
            </option>
            <option
                value="Vanuatu"
                {!! $teacher->country == 'Vanuatu'?'selected':'' !!}>
                {!! trans('countries.Vanuatu') !!}
            </option>
            <option
                value="Venezuela"
                {!! $teacher->country == 'Venezuela'?'selected':'' !!}>
                {!! trans('countries.Venezuela') !!}
            </option>
            <option value="Viet Nam"
                {!! $teacher->country == 'Viet Nam'?'selected':'' !!}>
                {!! trans('countries.Viet Nam') !!}
            </option>
            <option value="Virgin Islands, British"
                {!! $teacher->country == 'Virgin Islands, British'?'selected':'' !!}>
                {!! trans('countries.Virgin Islands, British') !!}
            </option>
            <option value="Virgin Islands, U.s."
                {!! $teacher->country == 'Virgin Islands, U.s.'?'selected':'' !!}>
                {!! trans('countries.Virgin Islands, U.s.') !!}
            </option>
            <option value="Wallis and Futuna"
                {!! $teacher->country == 'Wallis and Futuna'?'selected':'' !!}>
                {!! trans('countries.Wallis and Futuna') !!}
            </option>
            <option
                value="Western Sahara"
                {!! $teacher->country == 'Western Sahara'?'selected':'' !!}>
                {!! trans('countries.Western Sahara') !!}
            </option>
            <option value="Yemen"
                {!! $teacher->country == 'Yemen'?'selected':'' !!}>
                {!! trans('countries.Yemen') !!}
            </option>
            <option value="ZM"
                {!! $teacher->country == 'Zambia'?'selected':'' !!}>
                {!! trans('countries.Zambia') !!}
            </option>
            <option value="ZW"
                {!! $teacher->country == 'Zimbabwe'?'selected':'' !!}>
                {!! trans('countries.Zimbabwe') !!}
            </option>
        </select>


        <span class="form-text text-danger"
              id="country_error"></span>
    </div>
</div>
<!--end::Group-->
