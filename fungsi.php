<?php

if (!session_id()) session_start();

function base_url()
{
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    $domain = $_SERVER['HTTP_HOST'];
    $port = $_SERVER['SERVER_PORT'] != 80 && $_SERVER['SERVER_PORT'] != 443 ? ':' . $_SERVER['SERVER_PORT'] : '';
    $path = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);
    return $protocol . "://" . $domain . $port . $path;
}

define('BASE_URL', base_url());

function validate(array $inputs)
{
    foreach ($inputs as $key => $rules) {
        $explode_rules = array_map('trim', explode('|', $rules));

        foreach ($explode_rules as $rule) {
            switch ($rule) {
                case 'required':
                    if (empty(post($key))) {
                        if (!isset($_SESSION['errors'][$key])) {
                            $_SESSION['errors'][$key] = ucwords($key) . ' wajib diisi.';
                        }
                    }
                    break;
                case 'email':
                    if (!filter_var(post($key), FILTER_VALIDATE_EMAIL)) {
                        if (!isset($_SESSION['errors'][$key])) {
                            $_SESSION['errors'][$key] = 'Format email tidak valid';
                        }
                    }
                    break;
                default:
                    echo "Rule tidak ditemukan!";
                    die;
                    break;
            }
        }

        $_SESSION['old'][$key] = post($key);
    }

    if (has_error()) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
}

function errors()
{
    return $_SESSION['errors'];
}

function error($key)
{
    if (!empty($_SESSION['errors'])) {
        $message = $_SESSION['errors'][$key];
        unset($_SESSION['errors'][$key]);
        return $message;
    }
}

function has_error($specific_key = null)
{
    if (isset($_SESSION['errors'])) {
        if ($_SESSION['errors']) {
            if ($specific_key != null) {
                if (isset($_SESSION['errors'][$specific_key])) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return true;
            }
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function old($key)
{
    if (isset($_SESSION['old'])) {
        if (isset($_SESSION['old'][$key])) {
            $old = $_SESSION['old'][$key];
            unset($_SESSION['old'][$key]);
            return $old;
        }
    }
}

function last_value($key)
{
    if (isset($_SESSION['old'])) {
        if (isset($_SESSION['old'][$key])) {
            $old = $_SESSION['old'][$key];
            return $old;
        }
    }
}

function post($key)
{
    return htmlspecialchars($_POST[$key], ENT_QUOTES, 'UTF-8');
}

function abort($code)
{
    if ($code == '404') {
        include 'errors/404.php';

        header("HTTP/1.0 404 Not Found");
        exit();
    } elseif ($code == '500') {
        include 'errors/500.php';

        header("HTTP/1.0 500 Server Error");
        exit();
    } else {
        include 'errors/503.php';

        header("HTTP/1.0 503 Service Unavailable");
        exit();
    }
}

function select_old($value, $old_value = null, $edit = false, $edited_value = null)
{
    if (!is_null($old_value)) {
        return ($value == $old_value ? 'selected' : '');
    } else {
        if ($edit) {
            return ($value == $edited_value ? 'selected' : '');
        }
    }
}

function set_flash($type, $message)
{
    $_SESSION['flash'] = [
        'message' => $message,
        'type' => $type
    ];
}

function flash()
{
    if (isset($_SESSION['flash'])) {
        echo '<div class="alert alert-' . $_SESSION['flash']['type'] . '" role="alert">
            ' . $_SESSION['flash']['message'] . '
        </div>';

        unset($_SESSION['flash']);
    }
}

function back()
{
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

function tampil_data($table, $join = null, $condition = null)
{
    global $conn;

    $sql = "SELECT * FROM $table";
    if ($join) {
        $sql .= " $join";
    }
    if ($condition) {
        $sql .= " WHERE $condition";
    }

    return mysqli_query($conn, $sql);
}


function tambah_data($table, $data)
{
    global $conn;

    $keys = array_keys($data);
    $values = array_values($data);

    $sql = "INSERT INTO $table (" . implode(",", $keys) . ") VALUES ('" . implode("','", $values) . "')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        return true;
    } else {
        return false;
    }
}

function update_data($table, $data, $condition)
{
    global $conn;

    $set = array();
    foreach ($data as $key => $value) {
        $set[] = "$key = '$value'";
    }
    $set = implode(", ", $set);

    $sql = "UPDATE $table SET $set WHERE $condition";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        return true;
    } else {
        return false;
    }
}

function hapus_data($table, $condition)
{
    global $conn;

    $sql = "DELETE FROM $table WHERE $condition";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        return true;
    } else {
        return false;
    }
}

function nama_bulan($bulan)
{
    switch ($bulan) {
        case '1':
            return 'Januari';
            break;
        case '2':
            return 'Februari';
            break;
        case '3':
            return 'Maret';
            break;
        case '4':
            return 'April';
            break;
        case '5':
            return 'Mei';
            break;
        case '6':
            return 'Juni';
            break;
        case '7':
            return 'Juli';
            break;
        case '8':
            return 'Agustus';
            break;
        case '9':
            return 'September';
            break;
        case '10':
            return 'Oktober';
            break;
        case '11':
            return 'November';
            break;
        case '12':
            return 'Desember';
            break;
    }
}
