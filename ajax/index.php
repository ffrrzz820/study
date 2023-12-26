<?
// require_once 'inner_ip_array.php';


$edit = array_key_exists('edit', $_GET) ? 'y' : 'n';

$data_file_name = 'data.tsv';

if(isset($_POST['text'])) {
    $fp = fopen($data_file_name, 'w');
    fwrite($fp, $_POST['text']);
    fclose($fp);
	//echo('file save : '. $_POST['text']);
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>DATA Search</title>
	<script type="text/javascript" src="//code.jquery.com/jquery-1.12.4.min.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
	<style type="text/css">
		table {
			border: solid 1px #000;
			border-right: none;
			border-bottom: none;
		}
		th, td {
			border-right: solid 1px #000;
			border-bottom: solid 1px #000;
		}
	</style>
</head>
<body>
<?
if( $edit=='y' ) {
	$data_fileRead = htmlspecialchars(file_get_contents($data_file_name));

?>
<body>
	<div class="wrap">
		<!-- h1><a href=''>메모장</a></h1 -->
		<form name="edit" action="." method="post">
			<table border=0>
			<tr>
				<td style="text-align:center;width:250px;">data.tsv 저장 </td>
				<td style="text-align:center;"><input style="height:40px;width:80pt;" type="button" id="btnSave" value="저장" /></td>
			</tr>
			<tr><td colspan=3>
				<textarea name="text" id="text" cols="70" rows="25"><?=$data_fileRead?></textarea>
			</td></tr>
		</form>
	</div>
</body>
<script>
	$(document).ready(function() {
		$("#btnSave").click(function(){
			var fm = document.edit;
			//var title = $( "#title" ).val();

			fm.submit();
		});
	});

</script>
<?
}
else {
?>
<body>
	<div id="app">
		<fieldset>
			<select v-model="s_header_idx">
				<option :value="null">{{ '__ALL__' }}</option>
				<option v-for="(header, idx) in headers" :key="header" :value="idx">{{ header }}</option>
			</select>
			<input type="text" v-model="search_keyword">
			&nbsp;&nbsp;&nbsp;<a href="./?edit">edit</a>
		</fieldset>
		<hr>
		<table cellspacing="0">
			<thead>
				<tr>
					<th v-for="header in headers" :key="header" scope="row">{{ header }}</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="row in c_rows">
					<td v-for="column in row">{{ column }}</td>
				</tr>
				<tr v-if="!allow_empty_keyword && !search_keyword.length">
					<td :colspan="headers.length">검색어를 입력해 주세요.</td>
				</tr>
			</tbody>
		</table>
	</div>
	<script type="text/javascript">
		//<![CDATA[
		(function() {
			const app = new Vue({
				el: '#app',
				data() {
					return {
						s_header_idx: null,
						search_keyword: '',
						// 기능 : allow_empty_keyword : true면 리스트를 보여주기 / false면 리스트를 안 보여주고 검색 가능
						allow_empty_keyword: false,
						headers: [],
						rows: [],
						data_filename: './data.tsv',
					}
				},
				created() {
					this.init();
				},
				computed: {
					c_rows() {
						if (!this.search_keyword.length) return this.allow_empty_keyword ? this.rows : [];

						return this.rows.filter(row => {
							if (this.s_header_idx !== null) return !!~row[this.s_header_idx].indexOf(this.search_keyword);

							return row.filter(column => ~column.indexOf(this.search_keyword)).length;
						})
					}
				},
				methods: {
					init() {
						this.loadData()
							.catch(this.errorHandler)
					},
					async loadData() {
						let { data } = await axios.get(this.data_filename);
						data = data.split('\n');

						this.headers = this.arrangeRow(data.shift());
						this.rows = data.map(row => this.arrangeRow(row));
					},
					arrangeRow(row) {
						return row.split('\t');
					},
					errorHandler(e) {
						alert(e.message);
					}
				}
			})
		})()
		//]]>
	</script>
<?
}
?>
</body>
</html>