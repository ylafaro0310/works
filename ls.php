<?php
// Exclude script name
$args = array_slice($argv,1);

// Exclude options
$target_dirs = array_filter($args,function($value){
  return !preg_match('/^-/',$value);
});

// Get options
$options = getopt("al");

$is_multiple_dirs = count($target_dirs) > 1 ? true : false;
foreach($target_dirs as $key => $target_dir){
  // Print target_dir name if it has multiple dirs
  if($is_multiple_dirs){
    if($key > 0){
      printf("\n\n");
    }
    printf($target_dir.":\n");
  }

  $scan_dirs = scandir($target_dir);  
  // If 'a' is specified, it exclude dirs beginning with '.'.
  if(!array_key_exists('a',$options)){
    $scan_dirs = array_filter($scan_dirs,function($value){
      return !preg_match('/^\.[^.]*/',$value);
    });
  }
  
  // Print result of scandir
  if(array_key_exists('l',$options)){
    $file_stats = [];
    foreach($scan_dirs as $dir){
      $path = $target_dir . '/' . $dir;
      $file_stats[] = getFileInfo($path);
    }
    $max_size = strlen(max(array_column($file_stats,'4')));
    
    $file_stats = array_map(function($value)use($max_size){
      $value[4] = str_pad($value[4],$max_size," ",STR_PAD_LEFT);
      $value = implode(' ',$value);
      return $value;
    },$file_stats);
    foreach($file_stats as $file_stat){
      printf($file_stat . "\n");
    }
  }else{
    printf(implode(' ',$scan_dirs));
  }
}

function getFileInfo($filename){
  $stat = stat($filename);
  $perms = getPerms(fileperms($filename));
  $owner = posix_getpwuid($stat['uid'])['name'];
  $group = posix_getgrgid($stat['gid'])['name'];
  $size = $stat['size'];
  $timestamp = date('n月 d H:i',$stat['atime']);
  return [
    // ファイルタイプ
    // パーミション
    $perms,
    // ハードリンクの数
    $stat['nlink'],
    // オーナー名
    $owner,
    // グループ名
    $group,
    // バイトサイズ
    $size,
    // タイムスタンプ
    $timestamp,
    // ファイル名 
    $filename
  ];
}

function getPerms($perms){
  switch ($perms & 0xF000) {
    case 0xC000: // ソケット
        $info = 's';
        break;
    case 0xA000: // シンボリックリンク
        $info = 'l';
        break;
    case 0x8000: // 通常のファイル
        $info = '-';
        break;
    case 0x6000: // ブロックスペシャルファイル
        $info = 'b';
        break;
    case 0x4000: // ディレクトリ
        $info = 'd';
        break;
    case 0x2000: // キャラクタスペシャルファイル
        $info = 'c';
        break;
    case 0x1000: // FIFO パイプ
        $info = 'p';
        break;
    default: // 不明
        $info = 'u';
  }

  // 所有者
  $info .= (($perms & 0x0100) ? 'r' : '-');
  $info .= (($perms & 0x0080) ? 'w' : '-');
  $info .= (($perms & 0x0040) ?
              (($perms & 0x0800) ? 's' : 'x' ) :
              (($perms & 0x0800) ? 'S' : '-'));

  // グループ
  $info .= (($perms & 0x0020) ? 'r' : '-');
  $info .= (($perms & 0x0010) ? 'w' : '-');
  $info .= (($perms & 0x0008) ?
              (($perms & 0x0400) ? 's' : 'x' ) :
              (($perms & 0x0400) ? 'S' : '-'));

  // 全体
  $info .= (($perms & 0x0004) ? 'r' : '-');
  $info .= (($perms & 0x0002) ? 'w' : '-');
  $info .= (($perms & 0x0001) ?
              (($perms & 0x0200) ? 't' : 'x' ) :
              (($perms & 0x0200) ? 'T' : '-'));

  return $info;
}