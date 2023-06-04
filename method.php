<?php
    require_once "koneksi.php";
    class Mie {
        public function get_mies(){
            global $koneksi;
            $query = "SELECT * FROM list";
            $data = array();
            $result = $koneksi->query($query);
            while ($row = mysqli_fetch_object($result)) {
                $data[] = $row;
            }
            $response = array('status' => 1, 'message' => 'List Mie.', 'data' => $data);
            header('Content-Type: application/json');
            echo json_encode($response);
        }

        public function get_mie($id = 0){
            global $koneksi;
            $query = "SELECT * FROM list";
            if ($id != 0) {
                $query .= " WHERE id=" . $id . " LIMIT 1";
            }
            $data = array();
            $result = $koneksi->query($query);
            while ($row = mysqli_fetch_object($result)) {
                $data[] = $row;
            }
            $response = array('status' => 1, 'message' => 'List Mie.', 'data' => $data);
            header('Content-Type: application/json');
            echo json_encode($response);
        }

        public function insert_mie(){
            global $koneksi;
            $arrcheckpost = array('product' => '', 'harga' => '', 'qty' => '');
            $hitung = count(array_intersect_key($_POST, $arrcheckpost));
            if ($hitung == count($arrcheckpost)) {
                $result = mysqli_query($koneksi, "INSERT INTO list SET product = '$_POST[product]', harga = '$_POST[harga]', qty = '$_POST[qty]'");
                if ($result) {
                    $response = array('status' => 1, 'message' => 'Product berhasil ditambahkan.');
                } else {
                    $response = array('status' => 0, 'message' => 'Product gagal ditambahkan.');
                }
            } else {
                $response = array('status' => 0, 'message' => 'Parameter Tidak Ditemukan');
            }
            header('Content-Type: application/json');
            echo json_encode($response);
        }

        function update_mie($id){
            global $koneksi;
            $arrcheckpost = array('product' => '', 'harga' => '', 'qty' => '');
            $hitung = count(array_intersect_key($_POST, $arrcheckpost));
            if ($hitung == count($arrcheckpost)) {
                $result = mysqli_query($koneksi, "UPDATE list SET product = '$_POST[product]', harga = '$_POST[harga]', qty = '$_POST[qty]' WHERE id='$id'");
                if ($result) {
                    $response = array('status' => 1, 'message' => 'Product berhasil diupdate.');
                } else {
                    $response = array('status' => 0, 'message' => 'Product gagal diupdate.');
                }
            } else {
                $response = array('status' => 0, 'message' => 'Parameter Tidak Ditemukan');
            }
            header('Content-Type: application/json');
            echo json_encode($response);
        }

        function delete_mie($id){
            global $koneksi;
            $query = "DELETE FROM list WHERE id=" . $id;
            if (mysqli_query($koneksi, $query)) {
                $response = array('status' => 1, 'message' => 'Product berhasil dihapus.');
            } else {
                $response = array('status' => 0, 'message' => 'Barang gagal dihapus.');
            }
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }