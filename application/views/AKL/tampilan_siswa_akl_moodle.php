<div class="alert alert-success" role="alert">
    <h4 class="text-center font-weight-bold">Siswa Moodle</h4>
</div>

<div class="row mb-2 mt-2">
    <div class="col-md">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID Siswa</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                $no = 1;
                                foreach ($siswa as $row) {
                                ?>
                                    <td class="text-center"><?php echo $no++; ?></td>
                                    <td><?= $row['id']; ?></td>
                                    <td><?= $row['firstname']; ?></td>
                                    <td class="text-center"><?= $row['lastname']; ?></td>
                                    <td class="text-center"><?= $row['status']; ?></td>
                                    <td class="text-center">
                                        <h5 class="text-center">
                                            <form action="<?= base_url() ?>Dashboard_akl/proses_block_user" method="post">
                                                <input type="text" value="<?= $row['id']; ?>" name="id" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['auth']; ?>" name="auth" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['confirmed']; ?>" name="confirmed" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['policyagreed']; ?>" name="policyagreed" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['deleted']; ?>" name="deleted" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['suspended']; ?>" name="suspended" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['mnethostid']; ?>" name="mnethostid" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['username']; ?>" name="username" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['password']; ?>" name="password" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['idnumber']; ?>" name="idnumber" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['firstname']; ?>" name="firstname" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['lastname']; ?>" name="lastname" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['email']; ?>" name="email" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['emailstop']; ?>" name="emailstop" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['icq']; ?>" name="icq" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['skype']; ?>" name="skype" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['yahoo']; ?>" name="yahoo" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['aim']; ?>" name="aim" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['msn']; ?>" name="msn" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['phone1']; ?>" name="phone1" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['phone2']; ?>" name="phone2" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['institution']; ?>" name="institution" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['department']; ?>" name="department" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['address']; ?>" name="address" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['city']; ?>" name="city" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['country']; ?>" name="country" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['lang']; ?>" name="lang" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['calendartype']; ?>" name="calendartype" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['theme']; ?>" name="theme" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['timezone']; ?>" name="timezone" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['firstaccess']; ?>" name="firstaccess" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['lastaccess']; ?>" name="lastaccess" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['lastlogin']; ?>" name="lastlogin" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['currentlogin']; ?>" name="currentlogin" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['lastip']; ?>" name="lastip" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['secret']; ?>" name="secret" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['picture']; ?>" name="picture" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['url']; ?>" name="url" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['description']; ?>" name="description" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['descriptionformat']; ?>" name="descriptionformat" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['mailformat']; ?>" name="mailformat" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['maildigest']; ?>" name="maildigest" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['maildisplay']; ?>" name="maildisplay" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['autosubscribe']; ?>" name="autosubscribe" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['trackforums']; ?>" name="trackforums" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['timecreated']; ?>" name="timecreated" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['timemodified']; ?>" name="timemodified" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['trustbitmask']; ?>" name="trustbitmask" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['imagealt']; ?>" name="imagealt" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['lastnamephonetic']; ?>" name="lastnamephonetic" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['firstnamephonetic']; ?>" name="firstnamephonetic" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['middlename']; ?>" name="middlename" class="form-control" readonly hidden>
                                                <input type="text" value="<?= $row['alternatename']; ?>" name="alternatename" class="form-control" readonly hidden>
                                                <button type="submit" class="btn btn-danger btn-sm text-white">Block</button>
                                            </form>
                                        </h5>
                                    </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>