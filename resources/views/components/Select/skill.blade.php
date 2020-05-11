<select id="skill" name="skill" autofocus="autofocus" class="form-control">
    <option value="" selected>All Skills</option>
    <option value="Student" @if (old("skill") == "Student") selected @endif>Student</option>
    <option value="Novice" @if (old("skill") == "Novice") selected @endif>Novice</option>
    <option value="Intermediate" @if (old("skill") == "Intermediate") selected @endif>Intermediate</option>
    <option value="Advanced" @if (old("skill") == "Advanced") selected @endif>Advanced</option>
    <option value="Expert" @if (old("skill") == "Expert") selected @endif>Expert</option>
</select>