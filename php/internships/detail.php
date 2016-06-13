<?php
# detail php file:
# Author: Tim Davis
# Author: Kellan Nealy

require "../login/validate_session.php";
include("common.php");
include("../db/query_db.php");
include("../render/page_builder.php");

# Prints main html for this internship detail
function print_detail_main($data) { ?>
        <?php
        if (count($data) > 0) {
            $data = $data[0];
            // loop to get rid of any 0000-00-00 dates
        	foreach($data as $field => $value) {
        		if($value == "0000-00-00") {
        			$data[$field] = "";
        		}
        		error_log($data[$field]);
        	}
            $intId = $data["InternshipId"];
            $orgId = $data["OrganizationId"];
            $intPosition = $data["Position Title"];
            $intCompany = $data["Organization"];
            $intDatePosted = $data["Date Posted"];
            $intStartDate = $data["Start Date"];
            $intEndDate = $data["End Date"];
            $intLocation = $data["Location"];
            $intAddress = $data["Address 1"];
            $intDescription = $data["Job Description"];
            $intLastUpdated = $data["Last Update"];
            $intExpiration = $data["Expiration Date"]; ?>

            <h1 id="internship_title"><?= $intPosition ?></h1>
            <div id="detail_container">
                <table id="internship_detail">
                    <tr>
                        <th>Company:</th>
                        <td>
                            <a href=../companies/detail.php?id=<?= $orgId ?> ><?= $intCompany ?></a>
                        </td>
                    </tr>
                    <tr>
                        <th>Date Posted:</th>
                        <td><?= $intDatePosted ?></td>
                    </tr>
                    <tr>
                        <th>Start Date:</th>
                        <td><?= $intStartDate ?></td>
                    </tr>
                    <tr>
                        <th>End Date:</th>
                        <td><?= $intEndDate ?></td>
                    </tr>
                        <th>Location:</th>
                        <td id="loc"><?= $intLocation ?></td>
                    </tr>
                    </tr>
                        <th>Address:</th>
                        <td id="addr"><?= $intAddress?></td>
                    </tr>
                    </tr>
                        <th>Last Updated:</th>
                        <td><?= $intLastUpdated ?></td>
                    </tr>
                    </tr>
                        <th>Expiration Date:</th>
                        <td><?= $intExpiration ?></td>
                    </tr>
                </table>

                <div id="internship_map"></div>
                <script>
                    var map;
                    function initMap() {
                        map = new google.maps.Map(document.getElementById('internship_map'), {
                            center: {lat: -34.397, lng: 150.644},
                            zoom: 12
                        });

                        var geocoder = new google.maps.Geocoder();
                        geocodeLocation(geocoder, map);
                    }

                    function geocodeLocation(geocoder, resultsMap) {

                        var address = document.getElementById("addr").innerHTML;

                        geocoder.geocode({'address': address}, function(results, status) {
                            if (status === google.maps.GeocoderStatus.OK) {
                                resultsMap.setCenter(results[0].geometry.location);
                                var marker = new google.maps.Marker({
                                    map: resultsMap,
                                    position: results[0].geometry.location
                                });
                            } else {
                                alert('Geocode was not successful for the following reason: ' + status);
                            }
                        });
                    }
                </script>
                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPiap5yVRu-6r2NVBmzIvLX0DnFzz6F18&callback=initMap"
                async defer></script>
            </div>
            <br />
            <h2 style="clear:both;">Description</h2>
            <hr />
            <p id="internship_description"><?= $intDescription ?></p>

        <?php } else { ?>
            <p>We're sorry, a result was not found.</p>
        <?php } ?>

        <hr />
        <!-- Buttons -->
        <a class="button" href="list.php"><div>Back to List</div></a>
        <?php if (isAdmin()) : ?>
            <a class="button" href="create.php"><div>Create new Internship</div></a>
            <a class="button" href="edit.php?id=<?= $intId ?>"><div>Edit</div></a>
            <a class="button" href="delete.php?id=<?= $intId ?>"><div>Delete</div></a>
        <?php endif ?>
<?php }

# Build detail page
$id = $_GET["id"];
$data = get_internship_detail($id);

render_header('Internships', true);
render_nav("", "list.php");
print_detail_main($data);
render_footer();

?>
