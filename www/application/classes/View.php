<?php defined('SYSPATH') or die('No direct script access.');
/**
 *
 * @author CodeX Team
 * @copyright (c) 2018 CodeX Team
 *
 * CodeX Media Core View Class
 *
 * inherit main Kohana_View class set_filename method to use project path if exists
 * or use application view by default
 *
 * If both project and application doesn't contain required file throw an View_Exception
 */
class View extends Kohana_View
{
    /**
     * @var string
     */
    protected $view_path = 'views';

    /**
     * Sets the view filename.
     *
     *     $view->set_filename($file);
     *
     * @param string $file view filename
     *
     * @throws View_Exception
     *
     * @return View
     */
    public function set_filename($file)
    {
        $application_path = Kohana::find_file($this->view_path, $file);
        $project_path = Kohana::find_file('../projects' . DIRECTORY_SEPARATOR . Arr::get($_SERVER, 'PROJECT', '') . DIRECTORY_SEPARATOR . $this->view_path, $file);

        if ($application_path === false && $project_path === false) {
            throw new View_Exception('The requested view :file could not be found', [
                ':file' => $file,
            ]);
        }

        // Store the file path locally
        if ($project_path === false) {
            $this->_file = $application_path;
        } else {
            $this->_file = $project_path;
        }

        return $this;
    }
}
