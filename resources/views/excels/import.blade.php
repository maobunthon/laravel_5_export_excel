<form action="/excel/import" method="post" enctype="multipart/form-data">

    {{ csrf_field() }}

    <input type="file" name="customer"><br/><br/>

    <input type="submit" value="Import" />

</form>

<form action="/excel/export" method="get" enctype="multipart/form-data">

    {{-- {{ method_field('PUT') }} --}}

    {{ csrf_field() }}

    <input type="submit" value="Export" />

</form>