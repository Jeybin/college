<?php

require_once ('Functions.php');

class Common extends Functions {

      public function uploads($file, $dest) {
              $Imagefile = $_FILES["$file"];
              //file properties
//              print_r($Imagefile);
              $fileName = $Imagefile['name'];
              $fileType = $Imagefile['type'];
              $fileSize = $Imagefile['size'];
              $fileTempName = $Imagefile['tmp_name'];
              $fileError = $Imagefile['error'];
              //file upload
              $fileName = 'xyz.abc.123.png';
              $fileExt = explode('.', $fileName);
              $fileExt = strtolower(end($fileExt));
              $allowedExt = array('png', 'jpeg', 'jpg', 'pdf');
              if (in_array($fileExt, $allowedExt)) {
                  if ($fileError === 0) {
                      if ($fileSize <= '2000000') {
                          $fileNew = uniqid('', TRUE) . '.' . $fileExt;
                          $fileDest = $dest . $fileNew;
                          if (!empty($_SESSION['crop_items'])) {
                              $crop_items = $_SESSION['crop_items'];
                          } else {
                              $crop_items = array();
                          }
                  //array_push($crop_items,$fileDest);
                          if (move_uploaded_file($fileTempName, $fileDest)) {

                              array_push($crop_items, $fileDest);
                              $_SESSION['crop_items'] = $crop_items;
                  //                               header("Location:./crop");
                  //                            echo sizeof($_SESSION['crop_items']);
                              return $fileDest;
                          }
                      } else {
                          echo "Image Upload Error";
                      }
                  }
              }
          }


      /*--------- location selector function -----------------*/

      public function loactionselector($fieldname) {  ?>

        <input type="text" class="form-control select_location selectedlocation"  readonly name="<?=$fieldname?>" placeholder="click to add location" required />
      	<input type="" name="latitude" class="latvalue hidden" />
      	<input type="" name="longitude" class="lonvalue hidden" />

        <div class="modal fade locationselectionmodal" id="locationSelectModal" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <input type="text" id="place_autocomplete" placeholder="Enter Your Location name [ Eg: Mala,kerala ]" autocomplete="on">
            </div>
            <div class="modal-body"><div class="map_view" id="map_view"></div></div>
            <div class="modal-footer">
                <button class="save_location closemapmodal" type="button" data-dismiss="modal">Use this Location</button>
            </div>
          </div>
        </div>
      </div> <?php }

      /*------------- Location selector with text field only (without map) ----------*/

      public function locationSelectorFieldOnly($fieldname) {?>
        <script type="text/javascript">
          function initialize() {
                var input = document.getElementById('searchTextField');
                var countryrestriction = {componentRestrictions: {'country': 'ind'}}; // limited search by india
                var autocomplete = new google.maps.places.Autocomplete(input,countryrestriction);
                google.maps.event.addListener(autocomplete, 'place_changed', function () {
                          var place = autocomplete.getPlace();
                          latitude = place.geometry.location.lat();
                      		longitude = place.geometry.location.lng();

                          address = place.formatted_address; // gets the formated address of the selected place from places object
                          splitaddress = address.split(","); // spliting the array
                     		  console.log(splitaddress);
                       		splitaddresslength = splitaddress.length;
                          if(splitaddresslength === 1) {
                            countryfrommap = splitaddress[splitaddresslength - 1]; // always the last one in array is country
                       			statefrommap = splitaddress[splitaddresslength - 1]; // and the second last one in array is state
                       			cityfrommap = splitaddress[splitaddresslength - 1];  // and same as above the third last one will be city
                          } else if(splitaddresslength <= 2) {
                       			countryfrommap = splitaddress[splitaddresslength - 1]; // always the last one in array is country
                       			statefrommap = splitaddress[splitaddresslength - 2]; // and the second last one in array is state
                       			cityfrommap = splitaddress[splitaddresslength - 2];  // and same as above the third last one will be city
                       		}
                       		else {
                       			countryfrommap = splitaddress[splitaddresslength - 1]; // always the last one in array is country
                       			statefrommap = splitaddress[splitaddresslength - 2]; // and the second last one in array is state
                       			cityfrommap = splitaddress[splitaddresslength - 3]; // and same as above the third last one will be city
                       		}
                        $('#searchTextField').val(address); // into full location field
                    		$('#citylocation_fieldonly').val(cityfrommap); // into city field
                    		$('#statelocation_fieldonly').val(statefrommap); // into state field
                    		$('#countrylocation_fieldonly').val(countryfrommap); // into country field
                    		$('#latvalue_fieldonly').val(latitude); // into hidden latitude
                    		$('#lonvalue_fieldonly').val(longitude); // into hidden longitude
                      });
              }
              google.maps.event.addDomListener(window, 'load', initialize);
        </script>
            <input id="searchTextField" type="text" name="<?=$fieldname?>" class="form-control" size="50">
            <input type="text" name="latitude_fieldonly" id="latvalue_fieldonly" class="hidden" />
          	<input type="text" name="longitude_fieldonly" id="lonvalue_fieldonly" class="hidden" />

      <?php }





}

?>
