<?php

class MenuTree
{
	var $data;

	function add_row($id, $parent, $li_attr, $label)
	{
		$this->data[$parent][] = array('id' => $id, 'li_attr' => $li_attr, 'label' => $label);
	}

	function generate_list($attr = '', $attrss = '')
	{
		return $this->ul(0, $attr, $attrss);
	}

	function ul($parent = 0, $attr = '', $attrss = '')
	{
		static $i = 1;
		$indent = str_repeat("\t\t", $i);
		if (isset($this->data[$parent])) {
			if ($attr) {
				$attr = ' ' . $attr;
			}
			if ($attrss) {
				$attrss = ' ' . $attrss;
			}
			$html = "\n$indent";
			$html .= "<ul $attr>";
			$i++;
			foreach ($this->data[$parent] as $row) {
				$child = $this->ul($row['id'], $attrss);
				$html .= "\n\t$indent";
				$html .= '<li' . $row['li_attr'] . '>';
				$html .= $row['label'];
				if ($child) {
					$i--;
					$html .= $child;
					$html .= "\n\t$indent";
				}
				$html .= '</li>';
			}
			$html .= "\n$indent</ul>";
			return $html;
		} else {
			return false;
		}
	}

	function clear()
	{
		$this->data = array();
	}
}
