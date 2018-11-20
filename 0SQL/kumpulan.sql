CREATE TABLE `tipe` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL,
  `tipe` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `tipe`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

INSERT INTO `tipe` (`id`, `created_at`, `updated_at`, `status`, `tipe`, `deskripsi`) VALUES
(1, '2018-11-11 01:34:21', '2018-11-11 07:34:29', 1, 'Instrumen Asesmen Lab PLB ULM',
  'Instrumen dari Bu Mirnawati Program Studi Pendidikan Luar Biasa FKIP ULM');


CREATE TABLE `db_abk`.`ttt` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `npm` INT NOT NULL ,
  `nama_mahasiswa` INT NOT NULL ,
  `ipk` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

  CREATE TABLE instrumen2 (
   `id` int(11) NOT NULL,
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            `status` int(1) NOT NULL ,
 'butir'  varchar(200),
 'gambar'  varchar(200)
)
