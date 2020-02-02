<?php

	class Paginate
	{
		public $currentPage;
		public $pageRows;
		public $rowCount;

		public function __construct($page = 1, $pageRows = 10, $rowCount = 0)
		{
			$this->currentPage = (int)$page;
			$this->pageRows = (int)$pageRows;
			$this->rowCount = (int)$rowCount;
		}

		public function next()
		{
			return $this->currentPage + 1;
		}

		public function previous()
		{
			return $this->currentPage - 1;
		}

		public function pageTotal()
		{
			return ceil($this->rowCount / $this->pageRows);
		}

		public function hasPrevious()
		{
			return $this->previous() >= 1 ? true : false;
		}

		public function hasNext()
		{
			return $this->next() <= $this->pageTotal() ? true : false;
		}

		public function offset()
		{
			return ($this->currentPage -1) * $this->pageRows;
		}
	}

?>