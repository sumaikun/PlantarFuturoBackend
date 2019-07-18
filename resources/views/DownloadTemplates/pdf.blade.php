<!DOCTYPE html>
<html>
<head>
	<title>FICHA TÉCNICA INDIVIDUO {{ $code }}</title>
	<style type="text/css">
		body,div,table,thead,tbody,tfoot,tr,th,td,p { font-family:"Sans-serif"; font-size:x-small }
		a.comment-indicator:hover + comment { background:#ffd; position:absolute; display:block; border:1px solid black; padding:0.5em;  } 
		a.comment-indicator { background:red; display:inline-block; border:1px solid black; width:0.5em; height:0.5em;  } 
		comment { display:none;  } 
	</style>
</head>
<body>
	<table cellspacing="0" border="0">
	<colgroup width="92"></colgroup>
	<colgroup width="34"></colgroup>
	<colgroup width="72"></colgroup>
	<colgroup width="18"></colgroup>
	<colgroup width="73"></colgroup>
	<colgroup width="108"></colgroup>
	<colgroup width="58"></colgroup>
	<colgroup width="56"></colgroup>
	<colgroup width="79"></colgroup>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 height="40" align="center" valign=middle bgcolor="#FFFFFF"><b><font color="#000000"><br><img src="http://plantarfuturo.com/wp-content/uploads/2019/04/cropped-Logo.png" width=92 height=40 hspace=0 vspace=1>
		</font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=7 rowspan=2 align="center" valign=middle bgcolor="#FFFFFF"><b><font color="#000000">FICHA T&Eacute;CNICA DE REGISTRO TALA FORESTAL INVENTARIO F&Iacute;SICO POR INDIVIDUO</font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=bottom bgcolor="#FFFFFF"><font color="#000000"><br><img src="http://plantarfuturo.com/wp-content/uploads/2019/04/cropped-Logo.png" width=68 height=37 hspace=5 vspace=2>
	</font></td>
	</tr>
	<tr><td></td>
		</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000" height="1" align="center" valign=top bgcolor="#FFFFFF"><b><font color="#000000"><br></font></b></td>
		<td align="center" valign=bottom bgcolor="#FFFFFF"><font color="#000000"><br></font></td>
		<td align="center" valign=bottom bgcolor="#FFFFFF"><font color="#000000"><br></font></td>
		<td align="center" valign=bottom bgcolor="#FFFFFF"><b><font color="#000000"><br></font></b></td>
		<td align="center" valign=bottom bgcolor="#FFFFFF"><b><font color="#000000"><br></font></b></td>
		<td align="center" valign=bottom bgcolor="#FFFFFF"><b><font color="#000000"><br></font></b></td>
		<td style="border-top: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF"><b><font color="#000000"><br></font></b></td>
		<td align="center" valign=bottom bgcolor="#FFFFFF"><b><font color="#000000"><br></font></b></td>
		<td style="border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF"><font color="#000000"><br></font></td>
	</tr>
	<tr>
		<td style="border-left: 1px solid #000000" height="15" align="right" valign=bottom bgcolor="#FFFFFF"><font color="#000000">Arbol No.</font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=bottom bgcolor="#FFFFFF" sdval="{{ $code }}" sdnum="1033;0;0"><font color="#000000">{{ $code }}</font></td>
		<td align="left" valign=bottom bgcolor="#FFFFFF"><font color="#000000"><br></font></td>
		<td align="left" valign=bottom bgcolor="#FFFFFF"><font color="#000000"><br></font></td>
		<td align="right" valign=bottom bgcolor="#FFFFFF"><font color="#000000">Fecha:</font></td>
		<td style="border-bottom: 1px solid #000000" colspan=2 align="center" valign=bottom bgcolor="#FFFFFF" sdval="43154" sdnum="1033;1033;M/D/YYYY"><font color="#000000">{{ $date }}</font></td>
		<td style="border-right: 1px solid #000000" align="left" valign=bottom bgcolor="#FFFFFF"><font color="#000000"><br></font></td>
	</tr>
	<tr>
		<td style="border-left: 1px solid #000000" height="1" align="left" valign=bottom bgcolor="#FFFFFF"><font color="#000000"><br></font></td>
		<td align="left" valign=bottom bgcolor="#FFFFFF"><font color="#000000"><br></font></td>
		<td align="left" valign=bottom bgcolor="#FFFFFF"><font color="#000000"><br></font></td>
		<td align="left" valign=bottom bgcolor="#FFFFFF"><font color="#000000"><br></font></td>
		<td align="left" valign=bottom bgcolor="#FFFFFF"><font color="#000000"><br></font></td>
		<td align="left" valign=bottom bgcolor="#FFFFFF"><font color="#000000"><br></font></td>
		<td style="border-bottom: 1px solid #000000" align="left" valign=bottom bgcolor="#FFFFFF"><font color="#000000"><br></font></td>
		<td style="border-bottom: 1px solid #000000" align="left" valign=bottom bgcolor="#FFFFFF"><font color="#000000"><br></font></td>
		<td style="border-right: 1px solid #000000" align="left" valign=bottom bgcolor="#FFFFFF"><font color="#000000"><br></font></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=9 height="15" align="center" valign=bottom bgcolor="#D9D9D9"><b><font color="#000000">Informaci&oacute;n del Proyecto</font></b></td>
		</tr>
	<tr>
		<td style="border-left: 1px solid #000000" height="15" align="left" valign=bottom bgcolor="#FFFFFF"><font color="#000000">Proyecto:</font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="center" valign=bottom bgcolor="#FFFFFF" sdnum="1033;0;0.00"><font color="#000000">{{ $project->name }} </font></td>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000" align="left" valign=bottom bgcolor="#FFFFFF"><font color="#000000">Contratista:           </font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign=bottom bgcolor="#FFFFFF" sdnum="1033;0;0.00"><font color="#000000">Plantar Futuro Inversiones</font></td>
		</tr>
	<tr>
		<td style="border-left: 1px solid #000000" height="15" align="left" valign=bottom bgcolor="#FFFFFF"><font color="#000000">Localizaci&oacute;n:</font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="center" valign=bottom bgcolor="#FFFFFF" sdnum="1033;0;0.00"><font color="#000000">{{ $project->location }}</font></td>
		<td style="border-left: 1px solid #000000" align="left" valign=bottom bgcolor="#FFFFFF"><font color="#000000">Interventor:</font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign=bottom bgcolor="#FFFFFF" sdnum="1033;0;0.00"><font color="#000000">{{ $project->inspector }}</font></td>
		</tr>
	<tr>
		<td style="border-left: 1px solid #000000" height="15" align="left" valign=bottom bgcolor="#FFFFFF"><font color="#000000">Coordenadas:</font></td>
		<td style="border-bottom: 1px solid #000000" align="left" valign=bottom bgcolor="#FFFFFF"><font color="#000000">x:</font></td>
		<td style="border-bottom: 1px solid #000000" align="left" valign=middle bgcolor="#FFFFFF" sdval="1142274" sdnum="1033;0;0"><font color="#000000">{{ $project->east_coord }}</font></td>
		<td style="border-bottom: 1px solid #000000" align="left" valign=bottom bgcolor="#FFFFFF">y: </td>
		<td style="border-bottom: 1px solid #000000" align="left" valign=middle bgcolor="#FFFFFF" sdval="1155849" sdnum="1033;0;0"><font color="#000000">{{ $project->north_coord }}</font></td>
		<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="left" valign=bottom bgcolor="#FFFFFF"><font color="#000000">Responsable:    </font></td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign=bottom bgcolor="#FFFFFF" sdnum="1033;0;0.00"><font color="#000000">{{ $project->responsible }}</font></td>
		</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 height="15" align="center" valign=bottom bgcolor="#D9D9D9"><b><font color="#000000">Datos Dendrol&oacute;gicos</font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="center" valign=bottom bgcolor="#D9D9D9"><b><font color="#000000">Caracterizaci&oacute;n del Individuo</font></b></td>
		</tr>
	<tr>
		<td style="border-left: 1px solid #000000" height="23" align="left" valign=bottom bgcolor="#FFFFFF"><font color="#000000">Nombre Com&uacute;n:</font></td>
		<td style="border-top: 1px solid #000000" align="left" valign=bottom bgcolor="#FFFFFF"><font color="#000000"><br></font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign=bottom bgcolor="#FFFFFF" sdnum="1033;0;0.00"><font color="#000000">{{ $common_name }} </font></td>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000" align="left" valign=bottom bgcolor="#FFFFFF"><font color="#000000"><br></font></td>
		<td style="border-top: 1px solid #000000" align="left" valign=bottom bgcolor="#FFFFFF"><font color="#000000">Altura (m)</font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="left" valign=middle bgcolor="#FFFFFF"><font color="#000000">Volumen (m3) </font></td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=bottom bgcolor="#FFFFFF"><font color="#000000"><br></font></td>
	</tr>
	<tr>
		<td style="border-left: 1px solid #000000" height="15" align="left" valign=bottom bgcolor="#FFFFFF"><font color="#000000">Nombre Cient&iacute;fico:       </font></td>
		<td align="left" valign=bottom bgcolor="#FFFFFF"><font color="#000000"><br></font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign=bottom bgcolor="#FFFFFF" sdnum="1033;0;0.00"><i><font color="#000000">{{ $scientific_name }}</font></i></td>
		<td style="border-left: 1px solid #000000" align="left" valign=bottom bgcolor="#FFFFFF"><font color="#000000">Comercial:</font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="right" valign=bottom bgcolor="#FFFFFF" sdval="2" sdnum="1033;0;0.00"><font color="#000000">{{ $commercial_heigth_m }}</font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="right" valign=bottom bgcolor="#FFFFFF" sdval="0.0687223392972767" sdnum="1033;0;0.00"><font color="#000000">{{ $commercial_volume_m3 }}</font></td>
		<td style="border-right: 1px solid #000000" align="left" valign=bottom bgcolor="#FFFFFF"><font color="#000000"><br></font></td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" colspan=4 height="15" align="left" valign=middle bgcolor="#FFFFFF"><font color="#000000">Origen:    Nativa       X           Ex&oacute;tica    </font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000" align="left" valign=middle bgcolor="#FFFFFF"><font color="#000000"><br></font></td>
		<td style="border-left: 1px solid #000000" align="left" valign=bottom bgcolor="#FFFFFF"><font color="#000000">Total:</font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="right" valign=bottom bgcolor="#FFFFFF" sdval="18" sdnum="1033;0;0.00"><font color="#000000">{{ $total_heigth_m }}</font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="right" valign=bottom bgcolor="#FFFFFF" sdval="0.618501053675491" sdnum="1033;0;0.00"><font color="#000000">{{ $total_volume_m3 }}</font></td>
		<td style="border-right: 1px solid #000000" align="left" valign=bottom bgcolor="#FFFFFF"><font color="#000000"><br></font></td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" height="15" align="left" valign=middle bgcolor="#FFFFFF"><font color="#000000"><br></font></td>
		<td style="border-bottom: 1px solid #000000" align="left" valign=middle bgcolor="#FFFFFF"><font color="#000000"><br></font></td>
		<td style="border-bottom: 1px solid #000000" align="left" valign=middle bgcolor="#FFFFFF"><font color="#000000"><br></font></td>
		<td style="border-bottom: 1px solid #000000" align="left" valign=middle bgcolor="#FFFFFF"><font color="#000000"><br></font></td>
		<td align="left" valign=middle bgcolor="#FFFFFF"><font color="#000000"><br></font></td>
		<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="left" valign=bottom bgcolor="#FFFFFF"><font color="#000000">DAP: </font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000" align="right" valign=middle bgcolor="#FFFFFF" sdval="0.25" sdnum="1033;0;0.00"><font color="#000000">{{ $dap }}</font></td>
		<td style="border-bottom: 1px solid #000000" align="left" valign=bottom bgcolor="#FFFFFF" sdnum="1033;0;0.00"><font color="#000000"><br></font></td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=bottom bgcolor="#FFFFFF"><font color="#000000"><br></font></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 height="15" align="center" valign=bottom bgcolor="#D9D9D9"><b><font color="#000000">Datos Paisaj&iacute;sticos </font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="center" valign=bottom bgcolor="#D9D9D9"><b><font color="#000000">Tipo de Manejo</font></b></td>
		</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000" height="15" align="left" valign=bottom bgcolor="#FFFFFF"><font color="#000000">Di&aacute;metro de copa (m):</font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000" align="left" valign=bottom bgcolor="#FFFFFF"><font color="#000000"><br></font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000" align="center" valign=bottom ><font color="#000000"><b>X: </b>{{ $x_cup_diameter_m }}<b> Y: </b>{{ $y_cup_diameter_m }}</font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000" align="left" valign=bottom><font color="#000000"><br></font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=bottom bgcolor="#FFFFFF"><font color="#000000"><br></font></td>
			<td style="border-top: 1px solid #000000; border-left: 1px solid #000000" align="left" valign=middle bgcolor="#FFFFFF">
				<font color="#000000">Tala</font>
			</td>
			<td style="border-top: 1px solid #000000" align="left" valign=middle bgcolor="#FFFFFF">
				<font color="#000000"><br></font>
			</td>
			<td style="border-top: 1px solid #000000" align="center" valign=middle bgcolor="#FFFFFF">
				<font color="#000000">@if($treatment == "Tala") X @endif</font>
			</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle bgcolor="#FFFFFF"><font color="#000000"><br></font></td>
	</tr>
	<tr>
		<td style="border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 height="15" align="center" valign=bottom bgcolor="#FFFFFF"><font color="#000000">Densidad de copa</font></td>
		<td style="border-right: 1px solid #000000" colspan=4 align="left" valign=middle bgcolor="#FFFFFF"><font color="#000000">Perman. Y/poda</font></td>
		
		<td style="border-top: 1px solid #000000" align="center" valign=middle bgcolor="#FFFFFF">
			<font color="#000000">@if($treatment == "Perman. Y/poda") X @endif</font>
		</td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 rowspan=2 height="40" align="center" valign=middle bgcolor="#FFFFFF">
			<font color="#000000">
				Espesa @if($cup_density == "Espesa")<b>X</b>@endif       
			</font>
			<font color="#000000">
				Media @if($cup_density == "Media")<b>X</b>@endif         
			</font>
			<font color="#000000">
				Clara  @if($cup_density == "Clara")<b>X</b>@endif
			</font>
		</td>
		<td style="border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="left" valign=bottom bgcolor="#FFFFFF"><font color="#000000">Bloqueo y T.</font></td>
		<td style="border-top: 1px solid #000000" align="left" valign=middle bgcolor="#FFFFFF">
			<font color="#000000"><br></font>
		</td>
		<td style="border-top: 1px solid #000000" align="center" valign=middle bgcolor="#FFFFFF">
			<font color="#000000">@if($treatment == "Bloque y T.") X @endif</font>
		</td>
		</tr>
	<tr>
		<td style="border-left: 1px solid #000000" align="left" valign=bottom bgcolor="#FFFFFF"><font color="#000000"><br></font></td>
		<td align="left" valign=bottom bgcolor="#FFFFFF"><font color="#000000"><br></font></td>
		<td align="left" valign=bottom bgcolor="#FFFFFF"><font color="#000000"><br></font></td>
		<td style="border-right: 1px solid #000000" align="left" valign=bottom bgcolor="#FFFFFF"><font color="#000000"><br></font></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 height="15" align="center" valign=bottom bgcolor="#D9D9D9"><b><font color="#000000">Estado F&iacute;sico</font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="center" valign=bottom bgcolor="#D9D9D9"><b><font color="#000000">Estado Sanitario</font></b></td>
		</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 rowspan=3 height="15" align="center" valign=middle bgcolor="#FFFFFF"><font color="#000000">{{ $condition }}</font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=4 rowspan=3 align="center" valign=middle bgcolor="#FFFFFF"><font color="#000000">{{ $health_status }}</font></td>
		</tr>
	<tr><td></td>
		</tr>
	<tr><td></td>
		</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 height="15" align="center" valign=bottom bgcolor="#D9D9D9"><b><font color="#000000">Productos y Posible Uso</font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="center" valign=bottom bgcolor="#D9D9D9"><b><font color="#000000">Observaciones</font></b></td>
		</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 rowspan=2 height="15" align="center" valign=middle bgcolor="#FFFFFF"><font color="#000000">{{ $products }}</font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=4 rowspan=2 align="center" valign=middle bgcolor="#FFFFFF"><font color="#000000">{{ $note }}</font></td>
		</tr>
	<tr><td></td>
		</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 height="15" align="center" valign=bottom bgcolor="#D9D9D9"><b><font color="#000000">Foto General</font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="center" valign=bottom bgcolor="#D9D9D9"><b><font color="#000000">Foto Producto </font></b></td>
		</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 rowspan=17 align="center" valign=bottom bgcolor="#FFFFFF" height="130">
			@if($project->phase == 1)
				@if(isset($idImage))
					<img src="http://plantarfuturo.com/ws/assets/images/{{ $idImage }}" height="200" style="width: 15%;">
				@endif
				@if(isset($generalImage))
					<img src="http://plantarfuturo.com/ws/assets/images/{{ $generalImage }}" height="200" style="width: 15%;">
				@endif
				@if(isset($referenceImage))
					<img src="http://plantarfuturo.com/ws/assets/images/{{ $referenceImage }}" height="200" style="width: 15%;">
				@endif
			@elseif($project->phase == 2)
				@if(isset($idImage))
					<img src="http://plantarfuturo.com/ws/assets/images/{{ $idImage }}" height="200" style="width: 20%;">
				@endif
				@if(isset($generalImage))
					<img src="http://plantarfuturo.com/ws/assets/images/{{ $generalImage }}" height="200" style="width: 20%;">
				@endif
			@elseif($project->phase == 3)
				@if(isset($referenceImage))
					<img src="http://plantarfuturo.com/ws/assets/images/{{ $referenceImage }}" height="200">
				@endif
			@endif
		</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 rowspan=17 align="center" valign=middle bgcolor="#FFFFFF">
			@if($project->phase == 2)
				@if(isset($afterImage))
					<img src="http://plantarfuturo.com/ws/assets/images/{{ $afterImage }}" height="200">
				@endif
			@endif
		</td>	
	</tr>
	<tr><td></td>
		</tr>
	<tr><td></td>
		</tr>
	<tr><td></td>
		</tr>
	<tr><td></td>
		</tr>
	<tr><td></td>
		</tr>
	<tr><td></td>
		</tr>
	<tr><td></td>
		</tr>
	<tr><td></td>
		</tr>
	<tr><td></td>
		</tr>
	<tr><td></td>
		</tr>
	<tr><td></td>
		</tr>
	<tr><td></td>
		</tr>
	<tr><td></td>
		</tr>
	<tr><td></td>
		</tr>
	<tr><td></td>
		</tr>
	<tr><td></td>
		</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000" height="15" align="left" valign=middle bgcolor="#FFFFFF"><b><font color="#000000">Firma:</font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000" align="left" valign=middle bgcolor="#FFFFFF"><b><font color="#000000"><br></font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000" align="left" valign=middle bgcolor="#FFFFFF"><b><font color="#000000"><br></font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000" align="left" valign=middle bgcolor="#FFFFFF"><b><font color="#000000"><br></font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle bgcolor="#FFFFFF"><b><font color="#000000"><br></font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="left" valign=middle bgcolor="#FFFFFF"><b><font color="#000000">Firma:</font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign=middle bgcolor="#FFFFFF"><b><font color="#000000"><br></font></b></td>
		</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000" height="15" align="left" valign=middle bgcolor="#FFFFFF"><b><font color="#000000">Nombre: </font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="left" valign=middle bgcolor="#FFFFFF"><b><font color="#000000">{{ $project->representative_name }}</font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="left" valign=middle bgcolor="#FFFFFF"><b><font color="#000000">Nombre:</font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="left" valign=middle bgcolor="#FFFFFF"><b><font color="#000000">Tomas Maya Maya</font></b></td>
		</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000" height="15" align="left" valign=middle bgcolor="#FFFFFF"><b><font color="#000000">Cargo:</font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000" align="left" valign=middle bgcolor="#FFFFFF"><b><font color="#000000">{{ $project->representative_position }}</font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000" align="left" valign=middle bgcolor="#FFFFFF"><b><font color="#000000"><br></font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000" align="left" valign=middle bgcolor="#FFFFFF"><b><font color="#000000"><br></font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle bgcolor="#FFFFFF"><b><font color="#000000"><br></font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="left" valign=middle bgcolor="#FFFFFF"><b><font color="#000000">Cargo:</font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="left" valign=middle bgcolor="#FFFFFF"><b><font color="#000000">Ingeniero Forestal Residente</font></b></td>
		</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 height="15" align="left" valign=bottom bgcolor="#FFFFFF"><b><font color="#000000">Representante de PLANTAR FUTURO</font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="left" valign=middle bgcolor="#FFFFFF"><b><font color="#000000">Representante de CONPACIFICO1</font></b></td>
		</tr>
</table>
</body>
</html>