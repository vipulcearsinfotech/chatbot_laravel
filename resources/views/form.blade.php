@extends('welcome')

@section('main_body')
    <h1>Index page</h1>

    <h3>Create Intent</h3>
    <form method="post" action="/intent/create">
        @csrf
        <label for="userPattern">User Pattern: </label>
        <input name="userPattern" type="text" placeholder="e.g. hi, greeting, hello" />
        <br />
        <br />
        <label for="intentname">Intent Name: </label>
        <input name="intentname" type="text" placeholder="e.g. Greeting intent" />
        <br />
        <br />
        <input type="submit" value="Submit" />
    </form>


    <h3>Add Question To Intent</h3>
    @if (isset($result) && sizeOf($result) > 0)
        <form method="post" action="/question/create">
            @csrf
            <label for="intent_id">Select a Intent</label>
            <select name="intent_id">
                @foreach ($result as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                @endforeach
            </select>
            <br />
            <br />
            <label for="sortid">Postion: </label>
            <input name="sortid" type="number" placeholder="e.g. 5" />
            <br />
            <br />
            <label for="question">Question: </label>
            <input name="question" type="text" placeholder="e.g. question" />
            <br />
            <br />
            <label for="datatype">Expected DataType from user</label><br />
            <input type="radio" id="text" name="datatype" value="text">
            <label for="text">Text</label><br>
            <input type="radio" id="number" name="datatype" value="number">
            <label for="number">Number</label><br>
            <input type="radio" id="date" name="datatype" value="date">
            <label for="date">Date</label><br>
            <input type="radio" id="file" name="datatype" value="file">
            <label for="file">File</label><br>
            <input type="radio" id="radio" name="datatype" value="radio">
            <label for="radio">Radio Option</label><br>
            <input type="radio" id="checkbox" name="datatype" value="checkbox">
            <label for="checkbox">Check Box Option</label><br>
            <br />
            <br />
            <label for="options">Option Values: </label>
            <input name="options" type="text" placeholder="e.g. Id, Licence" />
            <br />
            <br />
            <input type="submit" value="Submit" />
        </form>
    @else
        <p>create intent first</p>
    @endif
    <br />
    <br />
    <br />
    <div>
        <h2>Intent created</h2>
        @if (isset($result) && sizeOf($result) > 0)
            @foreach ($result as $item)
                <h4> {{ $item['name'] }}</h4>
                @foreach ($item['data'] as $q)
                    <p> {{ strval($q->sortid) . ') ' . $q->question }}</p>
                @endforeach
            @endforeach
        @else
            <p>no intent created</p>
        @endif
    </div>

    <br />
    <br />
    <br />


@endsection
