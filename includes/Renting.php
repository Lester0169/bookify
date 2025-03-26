<!-- Verification Modal for Becoming a Renter -->
<div class="modal fade" id="startRentingModal" tabindex="-1" aria-labelledby="startRentingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="startRentingModalLabel">Verification for Becoming a Renter</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="renterconfig.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="renterFullName" class="form-label">Full Name</label>
                        <input type="text" name="renterFullName" class="form-control" value="<?php echo htmlspecialchars($firstName . ' ' . $lastName); ?>" required>
                    </div>
                    <div class="mb-3">
    <label for="renterIdType" class="form-label">Type of ID</label>
    <select name="renterIdType" id="renterIdType" class="form-select" required>
        <option value="" disabled selected>Select the type of your ID</option>
        <option value="Barangay ID">Barangay ID</option>
        <option value="COMELEC / Voter’s ID / COMELEC Registration Form">COMELEC / Voter’s ID / COMELEC Registration Form</option>
        <option value="Employee’s ID / Office ID">Employee’s ID / Office ID</option>
        <option value="National ID">National ID</option>
        <option value="Pag-ibig ID">Pag-ibig ID</option>
        <option value="Phil-health ID">Phil-health ID</option>
        <option value="Philippine Identification (PhilID / ePhilID)">Philippine Identification (PhilID / ePhilID)</option>
        <option value="Philippine Postal ID">Philippine Postal ID</option>
        <option value="School ID">School ID</option>
        <option value="SSS ID">SSS ID</option>
    </select>
</div>

                    <div class="mb-3">
                        <label for="renterIdProof" class="form-label">Upload Valid ID</label>
                        <input type="file" name="renterIdProof" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="renterSelfieWithId" class="form-label">Selfie with Valid ID</label>
                        <input type="file" name="renterSelfieWithId" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="renterSocialMediaLinks" class="form-label">Social Media Links (FB, TWT, ETC) (Optional)</label>
                        <input type="text" name="renterSocialMediaLinks" class="form-control" placeholder="Enter your social media links">
                    </div>
                    <div class="mb-3">
                        <label for="renterCountry" class="form-label">Country</label>
                        <select class="form-select" id="renterCountry" name="renterCountry" onchange="showAddressFieldsRenter()" required>
                        <option value="">Select your country</option>
                            <option value="Australia">Australia</option>
                            <option value="Brazil">Brazil</option>
                            <option value="Canada">Canada</option>
                            <option value="China">China</option>
                            <option value="France">France</option>
                            <option value="Germany">Germany</option>
                            <option value="India">India</option>
                            <option value="Japan">Japan</option>
                            <option value="Mexico">Mexico</option>
                            <option value="Philippines">Philippines</option>
                            <option value="Russia">Russia</option>
                            <option value="South Africa">South Africa</option>
                            <option value="South Korea">South Korea</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="United States">United States</option>
                        </select>
                    </div>
                    <div id="renterAddressFields" style="display:none;">
                        <div class="mb-3">
                            <label for="renterCity" class="form-label">City or Municipality</label>
                            <select name="renterCity" id="renterCity" class="form-select" onchange="handleCityChangeRenter()" required>
                                <option value="">Select your city or municipality</option>
                                <option value="Baguio">Baguio</option>
                                    <option value="Batangas City">Batangas City</option>
                                    <option value="Butuan City">Butuan City</option>
                                    <option value="Cagayan de Oro">Cagayan de Oro</option>
                                    <option value="Cebu City">Cebu City</option>
                                    <option value="Dagupan">Dagupan</option>
                                    <option value="Davao City">Davao City</option>
                                    <option value="General Santos">General Santos</option>
                                    <option value="Iloilo City">Iloilo City</option>
                                    <option value="Lucena">Lucena</option>
                                    <option value="Malabon">Malabon</option>
                                    <option value="Makati">Makati</option>
                                    <option value="Mandaluyong">Mandaluyong</option>
                                    <option value="Manila">Manila</option>
                                    <option value="Marikina">Marikina</option>
                                    <option value="Navotas">Navotas</option>
                                    <option value="Olongapo">Olongapo</option>
                                    <option value="Pateros">Pateros</option>
                                    <option value="Pasig">Pasig</option>
                                    <option value="Quezon City">Quezon City</option>
                                    <option value="San Juan">San Juan</option>
                                    <option value="Taguig">Taguig</option>
                                    <option value="Tarlac City">Tarlac City</option>
                                    <option value="Zamboanga City">Zamboanga City</option>
                            </select>
                        </div>
                        <div class="mb-3" id="renterBarangayContainer" style="display:none;">
                            <label for="renterBarangay" class="form-label">Barangay</label>
                            <select class="form-select" id="renterBarangay" name="renterBarangay" required>
                                <option value="" disabled selected>Select Barangay</option>
                                <option value="Acacia">Acacia</option>
        <option value="Agdao">Agdao</option>
        <option value="Alambre">Alambre</option>
        <option value="Alejandra Navarro">Alejandra Navarro</option>
        <option value="Alfonso Angliongto Sr.">Alfonso Angliongto Sr.</option>
        <option value="Angalan">Angalan</option>
        <option value="Atan-awe">Atan-awe</option>
        <option value="Baganihan">Baganihan</option>
        <option value="Bago Aplaya">Bago Aplaya</option>
        <option value="Bago Gallera">Bago Gallera</option>
        <option value="Bago Oshiro">Bago Oshiro</option>
        <option value="Baguio">Baguio</option>
        <option value="Balengaeng">Balengaeng</option>
        <option value="Baliok">Baliok</option>
        <option value="Bangkas Heights">Bangkas Heights</option>
        <option value="Bantol">Bantol</option>
        <option value="Baracatan">Baracatan</option>
        <option value="Barangay 10-A">Barangay 10-A</option>
        <option value="Barangay 11-B">Barangay 11-B</option>
        <option value="Barangay 12-B">Barangay 12-B</option>
        <option value="Barangay 13-B">Barangay 13-B</option>
        <option value="Barangay 14-B">Barangay 14-B</option>
        <option value="Barangay 15-B">Barangay 15-B</option>
        <option value="Barangay 16-B">Barangay 16-B</option>
        <option value="Barangay 17-B">Barangay 17-B</option>
        <option value="Barangay 18-B">Barangay 18-B</option>
        <option value="Barangay 19-B">Barangay 19-B</option>
        <option value="Barangay 1-A">Barangay 1-A</option>
        <option value="Barangay 20-B">Barangay 20-B</option>
        <option value="Barangay 21-C">Barangay 21-C</option>
        <option value="Barangay 22-C">Barangay 22-C</option>
        <option value="Barangay 23-C">Barangay 23-C</option>
        <option value="Barangay 24-C">Barangay 24-C</option>
        <option value="Barangay 25-C">Barangay 25-C</option>
        <option value="Barangay 26-C">Barangay 26-C</option>
        <option value="Barangay 27-C">Barangay 27-C</option>
        <option value="Barangay 28-C">Barangay 28-C</option>
        <option value="Barangay 29-C">Barangay 29-C</option>
        <option value="Barangay 2-A">Barangay 2-A</option>
        <option value="Barangay 30-C">Barangay 30-C</option>
        <option value="Barangay 31-D">Barangay 31-D</option>
        <option value="Barangay 32-D">Barangay 32-D</option>
        <option value="Barangay 33-D">Barangay 33-D</option>
        <option value="Barangay 34-D">Barangay 34-D</option>
        <option value="Barangay 35-D">Barangay 35-D</option>
        <option value="Barangay 36-D">Barangay 36-D</option>
        <option value="Barangay 37-D">Barangay 37-D</option>
        <option value="Barangay 38-D">Barangay 38-D</option>
        <option value="Barangay 39-D">Barangay 39-D</option>
        <option value="Barangay 3-A">Barangay 3-A</option>
        <option value="Barangay 40-D">Barangay 40-D</option>
        <option value="Barangay 4-A">Barangay 4-A</option>
        <option value="Barangay 5-A">Barangay 5-A</option>
        <option value="Barangay 6-A">Barangay 6-A</option>
        <option value="Barangay 7-A">Barangay 7-A</option>
        <option value="Barangay 8-A">Barangay 8-A</option>
        <option value="Barangay 9-A">Barangay 9-A</option>
        <option value="Bato">Bato</option>
        <option value="Bayabas">Bayabas</option>
        <option value="Biao Escuela">Biao Escuela</option>
        <option value="Biao Guianga">Biao Guianga</option>
        <option value="Biao Joaquin">Biao Joaquin</option>
        <option value="Binugao">Binugao</option>
        <option value="Bucana">Bucana</option>
        <option value="Buda">Buda</option>
        <option value="Buhangin">Buhangin</option>
        <option value="Bunawan">Bunawan</option>
        <option value="Cabantian">Cabantian</option>
        <option value="Cadalian">Cadalian</option>
        <option value="Calinan">Calinan</option>
        <option value="Callawa">Callawa</option>
        <option value="Camansi">Camansi</option>
        <option value="Carmen">Carmen</option>
        <option value="Catalunan Grande">Catalunan Grande</option>
        <option value="Catalunan Pequeño">Catalunan Pequeño</option>
        <option value="Catigan">Catigan</option>
        <option value="Cawayan">Cawayan</option>
        <option value="Centro">Centro</option>
        <option value="Colosas">Colosas</option>
        <option value="Communal">Communal</option>
        <option value="Crossing Bayabas">Crossing Bayabas</option>
        <option value="Dacudao">Dacudao</option>
        <option value="Dalag">Dalag</option>
        <option value="Dalagdag">Dalagdag</option>
        <option value="Daliao">Daliao</option>
        <option value="Daliaon Plantation">Daliaon Plantation</option>
        <option value="Datu Salumay">Datu Salumay</option>
        <option value="Dominga">Dominga</option>
        <option value="Dumoy">Dumoy</option>
        <option value="Eden">Eden</option>
        <option value="Fatima">Fatima</option>
        <option value="Gatungan">Gatungan</option>
        <option value="Gov. Paciano Bangoy">Gov. Paciano Bangoy</option>
        <option value="Gov. Vicente Duterte">Gov. Vicente Duterte</option>
        <option value="Gumalang">Gumalang</option>
        <option value="Gumitan">Gumitan</option>
        <option value="Ilang">Ilang</option>
        <option value="Inayangan">Inayangan</option>
        <option value="Indangan">Indangan</option>
        <option value="Kap. Tomas Monteverde, Sr.">Kap. Tomas Monteverde, Sr.</option>
        <option value="Kilate">Kilate</option>
        <option value="Lacson">Lacson</option>
        <option value="Lamanan">Lamanan</option>
        <option value="Lampianao">Lampianao</option>
        <option value="Langub">Langub</option>
        <option value="Lapu-lapu">Lapu-lapu</option>
        <option value="Leon Garcia, Sr.">Leon Garcia, Sr.</option>
        <option value="Lizada">Lizada</option>
        <option value="Los Amigos">Los Amigos</option>
        <option value="Lubogan">Lubogan</option>
        <option value="Lumiad">Lumiad</option>
        <option value="Ma-a">Ma-a</option>
        <option value="Mabuhay">Mabuhay</option>
        <option value="Malagos">Malagos</option>
        <option value="Malitbog">Malitbog</option>
        <option value="Mandug">Mandug</option>
        <option value="Marilog">Marilog</option>
        <option value="Matina">Matina</option>
        <option value="Matina Aplaya">Matina Aplaya</option>
        <option value="Matina Pangi">Matina Pangi</option>
        <option value="Matina Town Square">Matina Town Square</option>
        <option value="Mauang">Mauang</option>
        <option value="Miral">Miral</option>
        <option value="Montevista">Montevista</option>
        <option value="Pablo">Pablo</option>
        <option value="Panabo">Panabo</option>
        <option value="Poblacion">Poblacion</option>
        <option value="Puan">Puan</option>
        <option value="Quimpo Boulevard">Quimpo Boulevard</option>
        <option value="San Antonio">San Antonio</option>
        <option value="San Francisco">San Francisco</option>
        <option value="San Isidro">San Isidro</option>
        <option value="San Rafael">San Rafael</option>
        <option value="Santa Ana">Santa Ana</option>
        <option value="Santa Maria">Santa Maria</option>
        <option value="Santo Niño">Santo Niño</option>
        <option value="Santo Tomas">Santo Tomas</option>
        <option value="Sirawan">Sirawan</option>
        <option value="Sulop">Sulop</option>
        <option value="Tagum">Tagum</option>
        <option value="Talomo">Talomo</option>
        <option value="Tibungco">Tibungco</option>
        <option value="Toril">Toril</option>
        <option value="Tugbok">Tugbok</option>
        <option value="Tumana">Tumana</option>
        <option value="Wangan">Wangan</option>
        <option value="Wawandue">Wawandue</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="renterStreetAddress" class="form-label">Street Address or Home Address</label>
                            <input type="text" name="renterStreetAddress" id="renterStreetAddress" class="form-control" placeholder="Provide your street address or home address">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="renterContactNumber" class="form-label">Contact Number</label>
                        <input type="text" name="renterContactNumber" class="form-control" value="<?php echo htmlspecialchars($phoneNumber); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="renterEmail" class="form-label">Email</label>
                        <input type="email" name="renterEmail" class="form-control" value="<?php echo htmlspecialchars($emailAddress); ?>" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="renterTermsCheck" required>
                        <label class="form-check-label" for="renterTermsCheck">By proceeding, you acknowledge that you agree to our Terms and Conditions.</label>
                    </div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>