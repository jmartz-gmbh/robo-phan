<?php

/**
 * Trait RoboPhan
 */
trait RoboPhan
{
    public function phanDownloadPhar(string $version = 'latest'){
        $latest = '2.5.0';
        $this->_exec('curl -L https://github.com/phan/phan/releases/download/'.$latest.'/phan.phar -o phan.phar');
    }

    public function phanExecute(bool $fail = true){
        $this->stopOnFail($fail);
        $this->_exec('php phan.phar');
    }

    public function phanRemovePhar(){
        $this->_exec('phan.phar');
    }

    public function phanDefaultConfig():string{
        return "<?php return [ 'target_php_version' => '7.4', 'directory_list' => [], 'exclude_analysis_directory_list' => [], ]; ?>";
    }

    public function phanInit(){
        $filename = 'config.php';
        $foldername = '.robo';

        if(file_exists($foldername) && is_dir($foldername)){
            if(file_exists($foldername.'/'.$filename) && !is_dir($foldername.'/'.$filename)){
                file_put_contents($foldername.'/'.$filename, $this->phanDefaultConfig());
            }
        }
    }

    public function phanCustomReport($config = []):string{
        $result = [];

        // @todo get report, create own

        return json_encode($result);
    }
}
