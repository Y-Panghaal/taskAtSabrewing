<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    
    public function index() {
        //dd(Auth::user(), Auth::user()->expected_family_type);
        $potentialPartners = User::where('gender', '!=', $this->getGender())
            ->whereBetween('annual_income', Auth::user()->expected_income)
            ->whereIn('occupation', $this->getExpectedOccupation())
            ->whereIn('family_type', $this->getExpectedFamilyType());
        if (in_array(strtolower(Auth::user()->expected_manglik), ['yes', 'no'])) {
            $potentialPartners = $potentialPartners->where('manglik', Auth::user()->expected_manglik);
        } elseif (strtolower(Auth::user()->expected_manglik) === 'both') {
            $potentialPartners = $potentialPartners->whereIn('manglik', [0,1]);
        }
        //dd($potentialPartners->toSql(), $potentialPartners->getBindings(), $potentialPartners->get(), $potentialPartners->get()->count());
        $potentialPartners = $potentialPartners->get();
        return view('dashboard', compact('potentialPartners'));
    }

    protected function getGender() {
        if (strtolower(Auth::user()->gender) === 'male') {
            return 0;
        } elseif (strtolower(Auth::user()->gender) === 'female') {
            return 1;
        }
        return 2;
    }

    protected function getExpectedOccupation() {
        return array_filter(
            array_map(
                function($occupation) {
                    switch (strtolower($occupation)) {
                        case 'private job':
                            return 0;
                        case 'government job':
                            return 1;
                        case 'business':
                            return 2;
                        default:
                            return null;
                    }
                }, 
                Auth::user()->expected_occupation
            ), 
            function($o) {
                return $o !== null;
            }
        );
    }

    protected function getExpectedFamilyType() {
        return array_filter(
            array_map(
                function($familyType) {
                    switch (strtolower($familyType)) {
                        case 'joint family':
                            return 0;
                        case 'nuclear family':
                            return 1;
                        default:
                            return null;
                    }
                },
                Auth::user()->expected_family_type
            ), 
            function($f) {
                return $f !== null;
            }
        );
    }

}
